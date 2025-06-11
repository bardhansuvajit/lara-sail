<?php

namespace App\Repositories;

use App\Interfaces\ProductListingInterface;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;
use App\Interfaces\CountryInterface;
use App\Interfaces\ProductPricingInterface;
use App\Interfaces\ProductImageInterface;

use App\Exports\ProductListingsExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductListingRepository implements ProductListingInterface
{
    private TrashInterface $trashRepository;
    private CountryInterface $countryRepository;
    private ProductPricingInterface $productPricingRepository;
    private ProductImageInterface $productImageRepository;

    public function __construct(
        TrashInterface $trashRepository, 
        ProductPricingInterface $productPricingRepository, 
        ProductImageInterface $productImageRepository, 
        CountryInterface $countryRepository
    )
    {
        $this->trashRepository = $trashRepository;
        $this->productPricingRepository = $productPricingRepository;
        $this->productImageRepository = $productImageRepository;
        $this->countryRepository = $countryRepository;
    }

    public function list(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
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
                        ->orWhere('tags', 'like', '%' . $keyword . '%');
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

    public function store(Array $array)
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
            $data->category_id = $array['category_id'];
            $data->collection_ids = $array['collection_ids'];

            $data->sku = $array['sku'];
            $data->track_quantity = $array['track_quantity'];
            $data->stock_quantity = $array['stock_quantity'];
            $data->allow_backorders = $array['allow_backorders'];
            $data->meta_title = $array['meta_title'];
            $data->meta_desc = $array['meta_description'];
            $data->status = 2;
            $data->save();

            // PRICING
            $countryData = $this->countryRepository->getById($array['currency_country_id']);
            if ($countryData['code'] == 200) {
                $currencyCode = $countryData['data']->currency_code;
                $currencySymbol = $countryData['data']->currency_symbol;
            }
            $pricingData = [
                'product_id' => $data->id,
                'country_id' => $array['currency_country_id'],
                'currency_code' => $currencyCode,
                'currency_symbol' => $currencySymbol,
                'selling_price' => $array['selling_price'],
                'mrp' => $array['mrp'],
                'discount' => $array['discount_percentage'],
                'cost' => $array['cost'],
                'profit' => $array['profit'],
                'margin' => $array['margin_percentage'],
            ];
            $pricingResp = $this->productPricingRepository->store($pricingData);

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

    public function getById(Int $id)
    {
        try {
            // $data = Product::find($id);

            $data = Product::where('id', $id)
                ->with(['pricings', 'activeImages', 'variations' => function($query) {
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

    public function getByIds(Array $ids)
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

    public function update(Array $array)
    {
        // dd($array);

        DB::beginTransaction();

        try {
            $data = $this->getById($array['id']);

            if ($data['code'] == 200) {
                if (!empty($array['type']))                 $data['data']->type = $array['type'];
                if (!empty($array['title']))                $data['data']->title = $array['title'];

                // slug
                if (!empty($array['slug']))                 $data['data']->slug = $array['slug'];
                else                                        $data['data']->slug = Str::slug($array['title']);

                if (!empty($array['short_description']))    $data['data']->short_description = $array['short_description'];
                if (!empty($array['long_description']))     $data['data']->long_description = $array['long_description'];
                if (!empty($array['category_id']))          $data['data']->category_id = $array['category_id'];
                if (!empty($array['collection_ids']))       $data['data']->collection_ids = $array['collection_ids'];

                if (!empty($array['sku']))                  $data['data']->sku = $array['sku'];
                if (!empty($array['track_quantity']))       $data['data']->track_quantity = $array['track_quantity'];
                if (!empty($array['stock_quantity']))       $data['data']->stock_quantity = $array['stock_quantity'];
                if (!empty($array['allow_backorders']))     $data['data']->allow_backorders = $array['allow_backorders'];
                if (!empty($array['meta_title']))           $data['data']->meta_title = $array['meta_title'];
                if (!empty($array['meta_description']))     $data['data']->meta_desc = $array['meta_description'];
                if (!empty($array['status']))               $data['data']->status = $array['status'];
                $data['data']->save();

                // PRICING
                if (
                    !empty($array['currency_country_id']) &&
                    !empty($array['selling_price'])
                ) {
                    // **** pricing 1 - setting up data
                    $countryData = $this->countryRepository->getById($array['currency_country_id']);
                    if ($countryData['code'] == 200) {
                        $currencyCode = $countryData['data']->currency_code;
                        $currencySymbol = $countryData['data']->currency_symbol;
                    }
                    $pricingData = [
                        'product_id' => $array['id'],
                        'country_id' => $array['currency_country_id'],
                        'currency_code' => $currencyCode,
                        'currency_symbol' => $currencySymbol,
                        'selling_price' => $array['selling_price'],
                        'mrp' => $array['mrp'],
                        'discount' => $array['discount_percentage'],
                        'cost' => $array['cost'],
                        'profit' => $array['profit'],
                        'margin' => $array['margin_percentage'],
                    ];

                    // **** pricing 2 - check if pricing exists for this product id & country id
                    $existingPricingData = $this->productPricingRepository->getByProductIdCountryId($array['id'], $array['currency_country_id']);

                    // **** pricing 2 - if pricing exists update it, else add new
                    if ($existingPricingData['code'] == 200) {
                        $existingPricingDataId = $existingPricingData['data']->id;
                        // dd($existingPricingDataId);
                        $pricingResp = $this->productPricingRepository->update($existingPricingDataId, $pricingData);
                    } else {
                        $pricingResp = $this->productPricingRepository->store($pricingData);
                    }
                }

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
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while updating data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function delete(Int $id)
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

    public function bulkAction(Array $array)
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
        try {
            $filePath = fileStore($file);
            $data = readCsvFile(public_path($filePath));
            // $processedCount = saveToDatabase($data, 'Product');

            // save into Database
            $processedCount = 0;

            foreach ($data as $item) {
                if (!isset($item['title'])) {
                    continue; // Skip rows without a title
                }

                $productCreated = Product::create([
                    'title' => $item['title'] ? $item['title'] : null,
                    'slug' => isset($item['title']) ? Str::slug($item['title']) : null,
                    'category_id' => $item['category_id'] ? $item['category_id'] : null,
                    'category_id' => $item['category_id'] ? $item['category_id'] : null,
                    'collection_ids' => $item['collection_ids'] ? $item['collection_ids'] : null,
                    'short_description' => $item['short_description'] ? $item['short_description'] : null,
                    'long_description' => $item['long_description'] ? $item['long_description'] : null,
                    'sku' => $item['sku'] ? $item['sku'] : null,
                    'barcode' => $item['barcode'] ? $item['barcode'] : null,
                    'has_variations' => $item['has_variations'] ? $item['has_variations'] : 0,
                    'stock_quantity' => $item['stock_quantity'] ? $item['stock_quantity'] : null,
                    'track_quantity' => $item['track_quantity'] ? $item['track_quantity'] : 0,
                    'allow_backorders' => $item['allow_backorders'] ? $item['allow_backorders'] : 0,
                    'sold_count' => $item['sold_count'] ? $item['sold_count'] : 0,
                    'in_cart_count' => $item['in_cart_count'] ? $item['in_cart_count'] : 0,
                    'weight' => $item['weight'] ? $item['weight'] : 0,
                    'height' => $item['height'] ? $item['height'] : 0,
                    'width' => $item['width'] ? $item['width'] : 0,
                    'length' => $item['length'] ? $item['length'] : 0,
                    'weight_unit' => $item['weight_unit'] ? $item['weight_unit'] : 'g',
                    'dimension_unit' => $item['dimension_unit'] ? $item['dimension_unit'] : 'cm',
                    'tags' => $item['tags'] ? $item['tags'] : null,
                    'meta_title' => $item['meta_title'] ? $item['meta_title'] : null,
                    'meta_desc' => $item['meta_desc'] ? $item['meta_desc'] : null,
                    'type' => $item['type'] ? $item['type'] : 'physical-product',
                    'status' => $item['status'] ? $item['status'] : 1,
                ]);

                // PRICING
                $countryData = $this->countryRepository->getById($item['currency_country_id']);
                if ($countryData['code'] == 200) {
                    $currencyCode = $countryData['data']->currency_code;
                    $currencySymbol = $countryData['data']->currency_symbol;

                    $pricingData = [
                        'product_id' => $productCreated->id,
                        'country_id' => $item['currency_country_id'],
                        'currency_code' => $currencyCode,
                        'currency_symbol' => $currencySymbol,
                        'selling_price' => $item['selling_price'] ? $item['selling_price'] : 0,
                        'mrp' => $item['mrp'] ? $item['mrp'] : 0,
                        'discount' => ($item['selling_price'] && $item['mrp']) ? discountPercentageCalc($item['selling_price'], $item['mrp']) : 0,
                        'cost' => $item['cost'] ? $item['cost'] : 0,
                        'profit' => ($item['selling_price'] && $item['cost']) ? profitCalc($item['selling_price'], $item['cost']) : 0,
                        'margin' => ($item['selling_price'] && $item['cost']) ? marginCalc($item['selling_price'], $item['cost']) : 0,
                    ];
                    $pricingResp = $this->productPricingRepository->store($pricingData);
                }

                $processedCount++;
            }

            return [
                'code' => 200,
                'status' => 'success',
                'message' => $processedCount.' Data uploaded',
                'data' => [],
            ];
        } catch (\Exception $e) {
            \Log::error('CSV Import Error: ' . $e->getMessage());

            return [
                'code' => 500,
                'status' => 'error',
                // 'message' => 'An error occurred while uploading data.',
                'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }

    public function export(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc', String $type)
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
