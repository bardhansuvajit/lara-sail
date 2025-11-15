<?php

namespace App\Repositories;

use App\Interfaces\ProductListingInterface;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;
use App\Interfaces\CountryInterface;
use App\Interfaces\ProductImageInterface;
use App\Interfaces\ProductPricingInterface;
use App\Interfaces\ProductBadgeCombinationInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

use App\Exports\ProductListingsExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductListingRepository implements ProductListingInterface
{
    private TrashInterface $trashRepository;
    private CountryInterface $countryRepository;
    private ProductImageInterface $productImageRepository;
    private ProductPricingInterface $productPricingRepository;
    private ProductBadgeCombinationInterface $productBadgeCombinationRepository;
    private array $defaultType;

    public function __construct(
        TrashInterface $trashRepository, 
        CountryInterface $countryRepository,
        ProductImageInterface $productImageRepository, 
        ProductPricingInterface $productPricingRepository, 
        ProductBadgeCombinationInterface $productBadgeCombinationRepository,
        array $defaultType = []
    )
    {
        $this->trashRepository = $trashRepository;
        $this->countryRepository = $countryRepository;
        $this->productImageRepository = $productImageRepository;
        $this->productPricingRepository = $productPricingRepository;
        $this->productBadgeCombinationRepository = $productBadgeCombinationRepository;
    }

    public function list(?String $keyword = '', array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = Product::query();

            // keyword
            if (!empty($keyword)) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('slug', 'like', '%' . $keyword . '%')
                        ->orWhere('short_description', 'like', '%' . $keyword . '%')
                        ->orWhere('long_description', 'like', '%' . $keyword . '%')
                        ->orWhere('search_tags', 'like', '%' . $keyword . '%');
                });
            }

            // filters
            foreach ($filters as $field => $value) {
                if (!is_null($value) && $value !== '') {
                    if (is_array($value)) {
                        $query->whereIn($field, $value);
                    } else {
                        $query->where($field, '=', $value);
                    }
                }
            }

            // page
            $data = $perPage !== 'all'
            ? $query->orderBy($sortBy, $sortOrder)->paginate($perPage)->withQueryString()
            : $query->orderBy($sortBy, $sortOrder)->get();

            if ($data->isNotEmpty()) {
                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data found',
                    'data' => $data,
                ];
            }
    
            return [
                'code' => 404,
                'status' => 'failure',
                'message' => 'No data found',
                'data' => [],
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while fetching data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function store(array $array)
    {
        // dd($array);

        DB::beginTransaction();

        try {
            // product listing
            $data = new Product();
            $data->type = $array['type'];
            $data->title = $array['title'];
            $data->slug = Str::slug($array['title']);
            $data->short_description = $array['short_description'];
            $data->long_description = $array['long_description'];
            $data->category_id = $array['category_id'] ?? null;
            $data->collection_ids = !empty($array['collection_ids']) ? $array['collection_ids'] : null;

            $data->sku = $array['sku'];
            $data->track_quantity = $array['track_quantity'];
            $data->stock_quantity = $array['stock_quantity'];
            $data->allow_backorders = $array['allow_backorders'];
            $data->meta_title = $array['meta_title'];
            $data->meta_desc = $array['meta_description'];
            $data->status = DEFAULT_PROD_STAT_ID;
            $data->save();

            // PRICING
            if (!empty($array['pricing']) && count($array['pricing']) > 0) {
                foreach ($array['pricing'] as $key => $pricing) {
                    $pricingData = [
                        'product_id' => $data->id,
                        'country_code' => $pricing['country_code'],
                        'selling_price' => $pricing['selling_price'],
                        'mrp' => $pricing['mrp'],
                        'discount' => $pricing['discount_percentage'],
                        'cost' => $pricing['cost'],
                        'profit' => $pricing['profit'],
                        'margin' => $pricing['margin_percentage'],
                    ];
                    $pricingResp = $this->productPricingRepository->store($pricingData);
                }
            }

            // IMAGES
            if (!empty($array['images']) && count($array['images']) > 0) {
                foreach($array['images'] as $imageKey => $singleImage) {
                    $uploadResp = fileUpload($singleImage, 'p-img');

                    $imageData = [
                        'product_id' => $data->id,
                        'image_s' => $uploadResp['smallThumbName'],
                        'image_m' => $uploadResp['mediumThumbName'],
                        'image_l' => $uploadResp['largeThumbName'],
                    ];
                    $imageResp = $this->productImageRepository->store($imageData);
                }
            }

            // BADGES
            if (!empty($array['badges']) && count($array['badges']) > 0) {
                foreach($array['badges'] as $badgeKey => $badgeId) {
                    $badgeCombinationData = [
                        'product_id' => $data->id,
                        'product_badge_id' => $badgeId,
                    ];
                    $badgeCombinationResp = $this->productBadgeCombinationRepository->store($badgeCombinationData);
                }
            }

            // COMPANY DOMAIN
            $companyDomain = applicationSettings('company_domain');
            if ($companyDomain == 'ed-tech') {
                $edTechPayload = [
                    'board_id'   => $array['board_id']   ?? null,
                    'class_id'   => $array['class_id']   ?? null,
                    'subject_id' => $array['subject_id'] ?? null,
                    'school_id'  => $array['school_id']  ?? null,
                    'content'    => $array['content']  ?? null,
                ];

                if (!empty(array_filter($edTechPayload))) {
                    $data->edTechSection()->updateOrCreate(
                        ['product_id' => $data->id],
                        $edTechPayload
                    );
                }
            }

            DB::commit();

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Changes have been saved',
                'data' => $data,
            ];
        } catch (\Exception $e) {
            DB::rollback();

            return [
                'code' => 500,
                'status' => 'error',
                // 'message' => 'An error occurred while storing data.',
                'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getById(int $id)
    {
        try {
            // $data = Product::find($id);

            $data = Product::where('id', $id)
                ->with(['pricings', 'statusDetail', 'activeImages', 'variations' => function($query) {
                    $query->with('product.pricings');
                }])
                ->first();

            if (!empty($data)) {
                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data found',
                    'data' => $data,
                ];
            } else {
                return [
                    'code' => 404,
                    'status' => 'failure',
                    'message' => 'No data found',
                    'data' => [],
                ];
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while fetching data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getByIds(array $ids)
    {
        try {
            if (empty($ids)) {
                return [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'No IDs provided',
                    'data' => [],
                ];
            }

            $data = Product::whereIn('id', $ids)->get();

            if ($data->isNotEmpty()) {
                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data found',
                    'data' => $data,
                ];
            } else {
                return [
                    'code' => 404,
                    'status' => 'failure',
                    'message' => 'No data found',
                    'data' => [],
                ];
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while fetching data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getBySlug(String $slug)
    {
        try {
            $data = Product::where('slug', $slug)->first();

            if (!empty($data)) {
                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data found',
                    'data' => $data,
                ];
            } else {
                return [
                    'code' => 404,
                    'status' => 'failure',
                    'message' => 'No data found',
                    'data' => [],
                ];
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while fetching data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getBySlugFDCustomArr(String $slug)
    {
        try {
            $data = Product::select(['id', 'title', 'slug', 'category_id', 'short_description', 'long_description', 'average_rating', 'review_count', 'status'])
            ->with(['statusDetail', 'category', 'activeImages', 'FDPricing', 'activeVariations', 'reviews', 'badges', 'activeHighlights', 'activeFaqs', 'activeReviews'])
            ->where('slug', $slug)
            ->first();
            // ->toArray();

            if (!empty($data)) {
                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data found',
                    'data' => $data,
                ];
            } else {
                return [
                    'code' => 404,
                    'status' => 'failure',
                    'message' => 'No data found',
                    'data' => [],
                ];
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while fetching data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function update(array $array)
    {
        // dd($array);

        DB::beginTransaction();

        try {
            $data = $this->getById($array['id']);

            // dd($data);

            if ($data['code'] == 200) {
                $product = $data['data'];
                // dump('prod', $product, $array);
                if (!empty($array['type']))                 $product->type = $array['type'];
                if (!empty($array['title']))                $product->title = $array['title'];

                // slug
                if (!empty($array['slug']))                 $product->slug = $array['slug'];
                else                                        $product->slug = Str::slug($array['title']);

                if (!empty($array['short_description']))    $product->short_description = $array['short_description'];
                if (!empty($array['long_description']))     $product->long_description = $array['long_description'];
                $product->category_id = $array['category_id'] ?? 0;
                $product->collection_ids = $array['collection_ids'] ?? json_encode([]);

                if (!empty($array['sku']))                  $product->sku = $array['sku'];
                if (!empty($array['track_quantity']))       $product->track_quantity = $array['track_quantity'];
                if (!empty($array['stock_quantity']))       $product->stock_quantity = $array['stock_quantity'];
                if (!empty($array['allow_backorders']))     $product->allow_backorders = $array['allow_backorders'];
                if (!empty($array['meta_title']))           $product->meta_title = $array['meta_title'];
                if (!empty($array['meta_description']))     $product->meta_desc = $array['meta_description'];
                if (!empty($array['status']))               $product->status = $array['status'];
                $product->save();

                // dump('here', $product);

                // PRICING
                // dd($array);
                // Handle removed prices first
                if (!empty($array['removed_price_ids'])) {
                    foreach ($array['removed_price_ids'] as $removedId) {
                        $deleteResp = $this->productPricingRepository->delete($removedId);
                    }
                }

                // if (count($array['pricing']) > 0) {
                if (!empty($array['pricing']) && count($array['pricing']) > 0) {
                    // dd($array['pricing']);
                    foreach ($array['pricing'] as $key => $pricing) {

                        // dd($pricing);

                        if ($pricing['selling_price'] > 0) {
                            $pricingData = [
                                'product_id' => $array['id'],
                                'country_code' => $pricing['country_code'],
                                'selling_price' => $pricing['selling_price'],
                                'mrp' => $pricing['mrp'],
                                'discount' => $pricing['discount_percentage'],
                                'cost' => $pricing['cost'],
                                'profit' => $pricing['profit'],
                                'margin' => $pricing['margin_percentage'],
                            ];

                            // dd($pricingData);

                            // Update Existing Pricing
                            if (!empty($pricing['id'])) {
                                $pricingResp = $this->productPricingRepository->update($pricing['id'], $pricingData);
                            }
                            // Add New Pricing
                            else {
                                $pricingResp = $this->productPricingRepository->store($pricingData);
                            }
                        }

                        // dd($pricingResp);
                    }
                }
                // dd($array);

                // IMAGES
                if (!empty($array['images']) && count($array['images']) > 0) {
                    foreach($array['images'] as $imageKey => $singleImage) {
                        $uploadResp = fileUpload($singleImage, 'p-img');

                        $imageData = [
                            'product_id' => $array['id'],
                            'image_s' => $uploadResp['smallThumbName'],
                            'image_m' => $uploadResp['mediumThumbName'],
                            'image_l' => $uploadResp['largeThumbName'],
                        ];
                        $imageResp = $this->productImageRepository->store($imageData);
                    }
                }

                // BADGES
                // dd($array['badges']);
                if (!empty($array['badges']) && count($array['badges']) > 0) {

                    $productId = $array['id'];
                    $productBadgeResp = $this->productBadgeCombinationRepository->syncProductBadges($productId, $array['badges']);
                }

                // COMPANY DOMAIN
                $companyDomain = applicationSettings('company_domain');
                if ($companyDomain == 'ed-tech') {
                    $edTechPayload = [
                        'board_id'   => $array['board_id']   ?? null,
                        'class_id'   => $array['class_id']   ?? null,
                        'subject_id' => $array['subject_id'] ?? null,
                        'school_id'  => $array['school_id']  ?? null,
                        'content'    => $array['content']  ?? null,
                    ];

                    if (empty(array_filter($edTechPayload))) {
                        $product->edTechSection()->delete();
                    } else {
                        $product->edTechSection()->updateOrCreate(
                            ['product_id' => $product->id],
                            $edTechPayload
                        );
                    }
                }

                DB::commit();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Changes have been saved',
                    'data' => $data,
                ];
            } else {
                return $data;
            }
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Product update failed: '.$e->getMessage(), [
                'payload' => $array,
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while updating data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function delete(int $id)
    {
        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                // Handling trash
                $this->trashRepository->store([
                    'model' => 'Product',
                    'table_name' => 'products',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => $data['data']->image_s,
                    'title' => $data['data']->title,
                    'description' => $data['data']->title.' data deleted from products table',
                    'status' => 'deleted',
                ]);

                $data['data']->delete();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data deleted',
                    'data' => $data,
                ];
            } else {
                return $data;
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while deleting data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function bulkAction(array $array)
    {
        try {
            $data = Product::whereIn('id', $array['ids'])->get();
            if ($array['action'] == 'delete') {
                $data->each(function ($item) {
                    // Handling trash
                    $this->trashRepository->store([
                        'model' => 'Product',
                        'table_name' => 'products',
                        'deleted_row_id' => $item->id,
                        'thumbnail' => $item->image_s,
                        'title' => $item->title,
                        'description' => $item->title.' data deleted from products table',
                        'status' => 'deleted',
                    ]);

                    $item->delete();
                });

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data deleted',
                    'data' => [],
                ];
            } else {
                return [
                    'code' => 400,
                    'status' => 'failure',
                    'message' => 'Invalid action',
                    'data' => [],
                ];
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while updating data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function import(UploadedFile $file)
    {
        $summary = [
            'processed' => 0,
            'created' => 0,
            'failed' => 0,
            'errors' => [],
        ];

        // small helpers
        $toBool = fn($v) => filter_var($v, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ? 1 : 0;
        $toIntOrNull = fn($v) => ($v === '' || $v === null) ? null : (int)$v;
        $toFloatOrNull = fn($v) => ($v === '' || $v === null) ? null : (float)$v;
        $parseCollections = function($val) {
            // Accept JSON strings like "[1,2]" or comma separated "1,2"
            if ($val === null || $val === '') return null;
            if (is_array($val)) return $val;
            $val = trim($val);
            // try json decode
            $decoded = json_decode($val, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) return $decoded;
            // fallback: remove surrounding [] then explode
            $val = trim($val, "[] \t\n\r\0\x0B");
            if ($val === '') return null;
            return array_values(array_filter(array_map('trim', explode(',', $val)), fn($v) => $v !== ''));
        };

        try {
            $filePath = fileStore($file);
            $rows = readCsvFile(public_path($filePath)); // returns array of assoc rows

            foreach ($rows as $i => $row) {
                $summary['processed']++;

                // sanitize keys using Arr::get to avoid undefined index
                $title = trim(Arr::get($row, 'title', ''));
                if ($title === '') {
                    $summary['failed']++;
                    $summary['errors'][] = ['row' => $i + 1, 'reason' => 'missing title'];
                    continue;
                }

                // default product type based on application domain
                $companyDomain = applicationSettings('company_domain');
                $productTypes = developerSettings('company_category');
                $productType = collect($productTypes)->firstWhere('key', $companyDomain);
                $productTypeArray = json_decode(json_encode($productType), true);
                $defaultProductType = $productTypeArray['children'][0];

                // per-row try/catch so one bad row doesn't abort the whole import
                try {
                    DB::beginTransaction();

                    // Build product data (only fields you actually have in your Product model)
                    $collections = $parseCollections(Arr::get($row, 'collection_ids'));
                    $productData = [
                        'title' => $title,
                        // if CSV contains slug, use it; otherwise slugify title
                        'slug' => Str::slug(Arr::get($row, 'slug', $title)),
                        'category_id' => $toIntOrNull(Arr::get($row, 'category_id')),
                        // store collection_ids as JSON if your DB column expects JSON/text
                        'collection_ids' => $collections ? json_encode($collections) : null,
                        'short_description' => Arr::get($row, 'short_description') ?: null,
                        'long_description' => Arr::get($row, 'long_description') ?: null,
                        'sku' => Arr::get($row, 'sku') ?: null,
                        'barcode' => Arr::get($row, 'barcode') ?: null,
                        'has_variations' => $toBool(Arr::get($row, 'has_variations', 0)),
                        'stock_quantity' => $toIntOrNull(Arr::get($row, 'stock_quantity')),
                        'track_quantity' => $toBool(Arr::get($row, 'track_quantity', 0)),
                        'allow_backorders' => $toBool(Arr::get($row, 'allow_backorders', 0)),
                        'sold_count' => $toIntOrNull(Arr::get($row, 'sold_count', 0)),
                        'in_cart_count' => $toIntOrNull(Arr::get($row, 'in_cart_count', 0)),
                        'weight' => $toFloatOrNull(Arr::get($row, 'weight', 0)),
                        'height' => $toFloatOrNull(Arr::get($row, 'height', 0)),
                        'width' => $toFloatOrNull(Arr::get($row, 'width', 0)),
                        'length' => $toFloatOrNull(Arr::get($row, 'length', 0)),
                        'weight_unit' => Arr::get($row, 'weight_unit') ?: 'g',
                        'dimension_unit' => Arr::get($row, 'dimension_unit') ?: 'cm',
                        'search_tags' => Arr::get($row, 'search_tags') ?: null,
                        'meta_title' => Arr::get($row, 'meta_title') ?: null,
                        'meta_desc' => Arr::get($row, 'meta_desc') ?: null,
                        'type' => Arr::get($row, 'type', $defaultProductType) ?: $defaultProductType,
                        // use status from CSV if provided; default to 4/DEFAULT_PROD_STAT_ID so it matches your CSV defaults
                        'status' => $toIntOrNull(Arr::get($row, 'status', DEFAULT_PROD_STAT_ID)) ?? DEFAULT_PROD_STAT_ID,
                    ];

                    // OPTIONAL: avoid duplicate SKUs/slugs — if SKU exists, update instead of create
                    $existing = null;
                    if (!empty($productData['sku'])) {
                        $existing = \App\Models\Product::where('sku', $productData['sku'])->first();
                    }
                    if (!$existing && !empty($productData['slug'])) {
                        $existing = \App\Models\Product::where('slug', $productData['slug'])->first();
                    }

                    if ($existing) {
                        // update minimal fields (or skip)
                        $existing->fill($productData);
                        $existing->save();
                        $product = $existing;
                    } else {
                        // Ensure Product model allows mass assignment for these fields (add them to $fillable)
                        $product = \App\Models\Product::create($productData);
                    }

                    // PRICING — do it guarded: don't let pricing errors break import
                    $countryCode = Arr::get($row, 'country_code');
                    if ($countryCode) {
                        try {
                            // $countryResp = $this->countryRepository->getById($countryId);
                            // if (isset($countryResp['code']) && $countryResp['code'] == 200) {
                                // $currencyCode = $countryResp['data']->currency_code;
                                // $currencySymbol = $countryResp['data']->currency_symbol;

                                $selling = $toFloatOrNull(Arr::get($row, 'selling_price', 0)) ?? 0;
                                $mrp = $toFloatOrNull(Arr::get($row, 'mrp', 0)) ?? 0;
                                $cost = $toFloatOrNull(Arr::get($row, 'cost', 0)) ?? 0;

                                $pricingData = [
                                    'product_id' => $product->id,
                                    'country_code' => $countryCode,
                                    // 'country_id' => $countryId,
                                    // 'currency_code' => $currencyCode,
                                    // 'currency_symbol' => $currencySymbol,
                                    'selling_price' => $selling,
                                    'mrp' => $mrp,
                                    'discount' => ($selling && $mrp) ? discountPercentageCalc($selling, $mrp) : 0,
                                    'cost' => $cost,
                                    'profit' => ($selling && $cost) ? profitCalc($selling, $cost) : 0,
                                    'margin' => ($selling && $cost) ? marginCalc($selling, $cost) : 0,
                                ];

                                // Protect pricing creation from throwing fatal exception
                                try {
                                    $this->productPricingRepository->store($pricingData);
                                } catch (\Throwable $pe) {
                                    Log::warning("Pricing store failed for product {$product->id} (row ".($i+1)."): ".$pe->getMessage());
                                    // continue without stopping import
                                }
                            // } else {
                            //     Log::warning("Country not found for row ".($i+1)." country_id: {$countryId}");
                            // }
                        } catch (\Throwable $ce) {
                            Log::warning("Country lookup error for row ".($i+1).": ".$ce->getMessage());
                        }
                    }

                    DB::commit();
                    $summary['created']++;
                } catch (\Throwable $e) {
                    DB::rollBack();
                    $summary['failed']++;
                    $summary['errors'][] = ['row' => $i + 1, 'reason' => $e->getMessage()];
                    Log::error("CSV import row ".($i+1)." failed: ".$e->getMessage());
                    // continue to next row
                    continue;
                }
            }

            return [
                'code' => 200,
                'status' => 'success',
                'message' => "{$summary['created']} / {$summary['processed']} rows processed. {$summary['failed']} failed.",
                'data' => $summary,
            ];
        } catch (\Throwable $e) {
            Log::error('CSV Import Error: ' . $e->getMessage());
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'Import failed: ' . $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }

    public function export(?String $keyword = '', array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc', String $type)
    {
        try {
            $data = $this->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

            if (count($data['data']) > 0) {
                $fileName = "products_export_" . date('Y-m-d') . '-' . time();

                if ($type == 'excel') {
                    $fileExtension = ".xlsx";
                    return Excel::download(new ProductListingsExport($data['data']), $fileName.$fileExtension);
                }
                elseif ($type == 'csv') {
                    $fileExtension = ".csv";
                    return Excel::download(new ProductListingsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::CSV);
                }
                elseif ($type == 'html') {
                    $fileExtension = ".html";
                    return Excel::download(new ProductListingsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::HTML);
                }
                elseif ($type == 'pdf') {
                    $fileExtension = ".pdf";
                    return Excel::download(new ProductListingsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::TCPDF);
                }
                else {
                    return [
                        'code' => 400,
                        'status' => 'error',
                        'message' => 'Invalid export type.',
                    ];
                }
            } else {
                return [
                    'code' => 404,
                    'status' => 'error',
                    'message' => 'No data available for export.',
                ];
            }
        } catch (\Exception $e) {
            \Log::error('Export Repository Error: ' . $e->getMessage(), [
                'filters' => $filters,
                'exception' => $e
            ]);
    
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An unexpected error occurred while preparing the export.',
            ];
        }
    }
}
