<?php

namespace App\Repositories;

use App\Interfaces\ProductVariationInterface;
use App\Models\ProductVariation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;
use App\Interfaces\ProductVariationCombinationInterface;
use App\Interfaces\ProductPricingInterface;
use App\Interfaces\ProductImageInterface;
use App\Models\ProductVariationCombination;

use App\Exports\ProductVariationAttributesExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductVariationRepository implements ProductVariationInterface
{
    private TrashInterface $trashRepository;
    private ProductVariationCombinationInterface $productVariationCombinationRepository;
    private ProductImageInterface $productImageRepository;
    private ProductPricingInterface $productPricingRepository;

    public function __construct(
        TrashInterface $trashRepository, 
        ProductVariationCombinationInterface $productVariationCombinationRepository, 
        ProductImageInterface $productImageRepository,
        ProductPricingInterface $productPricingRepository
    )
    {
        $this->trashRepository = $trashRepository;
        $this->productVariationCombinationRepository = $productVariationCombinationRepository;
        $this->productImageRepository = $productImageRepository;
        $this->productPricingRepository = $productPricingRepository;
    }

    public function list(?String $keyword = '', array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = ProductVariation::query();

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
            ? $query->orderBy($sortBy, $sortOrder)->with('values.categories')->paginate($perPage)->withQueryString()
            : $query->orderBy($sortBy, $sortOrder)->with('values.categories')->get();

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
            $productId = $array['product_id'];

            // Check if this variation combination already exists for this product
            if (!empty($array['variations']) && count($array['variations']) > 0) {
                $existingVariation = $this->checkExistingVariation(
                    $productId,
                    $array['variations']
                );

                if ($existingVariation) {
                    return [
                        'code' => 409, // Conflict
                        'status' => 'error',
                        'message' => 'This variation combination already exists for this product',
                        'data' => $existingVariation
                    ];
                }
            }

            // dd($array);

            $identifierParts = collect($array['variations'])
                ->sortBy('attribute_id') // Ensure consistent order
                ->map(function ($variation) {
                    return Str::slug($variation['attribute_value_title']);
                });

            $variationIdentifier = $identifierParts->implode('-');

            $data = new ProductVariation();
            $data->product_id = $productId;
            $data->variation_identifier = $variationIdentifier;
            $data->sku = !empty($array['sku']) ? $array['sku'] : null;
            $data->barcode = !empty($array['barcode']) ? $array['barcode'] : null;
            $data->track_quantity = !empty($array['track_quantity']) ? $array['track_quantity'] : 0;
            $data->stock_quantity = !empty($array['stock_quantity']) ? $array['stock_quantity'] : 0;
            $data->allow_backorders = !empty($array['allow_backorders']) ? $array['allow_backorders'] : 0;
            $data->sold_count = !empty($array['sold_count']) ? $array['sold_count'] : 0;
            $data->in_cart_count = !empty($array['in_cart_count']) ? $array['in_cart_count'] : 0;
            $data->primary_image_id = !empty($array['primary_image_id']) ? $array['primary_image_id'] : null;

            // $data->price_adjustment = !empty($array['price_adjustment']) ? $array['price_adjustment'] : 0;
            // $data->adjustment_type = !empty($array['adjustment_type']) ? $array['adjustment_type'] : 'fixed';

            $data->weight_adjustment = !empty($array['weight_adjustment']) ? $array['weight_adjustment'] : 0;
            $data->height_adjustment = !empty($array['height_adjustment']) ? $array['height_adjustment'] : 0;
            $data->width_adjustment = !empty($array['width_adjustment']) ? $array['width_adjustment'] : 0;
            $data->length_adjustment = !empty($array['length_adjustment']) ? $array['length_adjustment'] : 0;
            $data->weight_unit = !empty($array['weight_unit']) ? $array['weight_unit'] : 'g';
            $data->dimension_unit = !empty($array['dimension_unit']) ? $array['dimension_unit'] : 'cm';
            $data->is_default = !empty($array['is_default']) ? $array['is_default'] : 0;

            // get max position for given attribute_id and type
            $lastPosition = ProductVariation::where('product_id', $productId)
            ->max('position');
            $data->position = $lastPosition ? $lastPosition + 1 : 1;

            $data->status = !empty($array['status']) ? $array['status'] : 0;
            $data->save();

            if (!empty($array['variations']) && count($array['variations']) > 0) {
                // $explodedValues = array_map('trim', explode(',', $array['values']));

                foreach ($array['variations'] as $key => $variation) {
                    $this->productVariationCombinationRepository->store([
                        'product_id' => $productId,
                        'variation_id' => $data->id,
                        'attribute_id' => $variation['attribute_id'],
                        'attribute_value_id' => $variation['attribute_value_id'],
                    ]);
                }
            }

            // if there is PRICE ADJUSTMENT, add data into Product Pricing
            if (count($array['currency_adjustments']) > 0) {
                // Looping through adjustments based on Country
                foreach ($array['currency_adjustments'] as $key => $currencyAdjust) {
                    // Add only if there is Adjustment
                    if ($currencyAdjust['price_adjustment'] > 0) {

                        // get base pricing details first
                        $existingProdPricing = $this->productPricingRepository->getByProductIdCountryCode($productId, $currencyAdjust['country_code']);

                        if ($existingProdPricing['code'] == 200) {
                            // dd($array);
                            $existingPricingData = $existingProdPricing['data'];

                            // return [
                            //     'code' => 409,
                            //     'status' => 'warning',
                            //     'message' => 'No Base Price found for this currency. Please add Base Price first',
                            //     'data' => []
                            // ];

                            // dd($existingPricingData);

                            // Selling Price
                            $variationSellingPrice = floatConvert($currencyAdjust['price_adjustment']);
                            // $baseSellingPrice = $existingPricingData['selling_price'];
                            // if ($currencyAdjust['adjustment_type'] == 'add') {
                            //     $variationSellingPrice = floatConvert($baseSellingPrice + $currencyAdjust['price_adjustment']);
                            // } else {
                            //     $variationSellingPrice = floatConvert($baseSellingPrice - $currencyAdjust['price_adjustment']);
                            // }

                            // treat empty MRP as 0 (or null)
                            $mrpRaw = $existingPricingData['mrp'] ?? null;
                            $mrp = ($mrpRaw === '' || is_null($mrpRaw)) ? 0.0 : floatConvert($mrpRaw);

                            // Discount, Cost, Profit, Margin
                            $discountPercentage = ($mrp > 0) ? discountPercentageCalc($variationSellingPrice, $mrp) : 0;

                            $costRaw = $existingPricingData['cost'] ?? null;
                            $cost = ($costRaw === '' || is_null($costRaw)) ? 0.0 : floatConvert($costRaw);

                            $profit = ($cost > 0) ? profitCalc($variationSellingPrice, $cost) : 0;
                            $marginPercentage = ($cost > 0) ? marginCalc($variationSellingPrice, $cost) : 0;

                            $pricingData = [
                                'product_id' => $productId,
                                'product_variation_id' => $data->id,
                                'country_code' => $currencyAdjust['country_code'],
                                'selling_price' => $variationSellingPrice,
                                'mrp' => $mrp,
                                'discount' => $discountPercentage,
                                'cost' => $cost,
                                'profit' => $profit,
                                'margin' => $marginPercentage,
                            ];
                            $pricingResp = $this->productPricingRepository->store($pricingData);
                        }
                    }
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

    protected function checkExistingVariation($productId, array $variations)
    {
        // Get all variation IDs for this product
        $variationIds = ProductVariation::where('product_id', $productId)
            ->pluck('id');

        if ($variationIds->isEmpty()) {
            return false;
        }

        // For each attribute-value pair in the new variation
        foreach ($variations as $variation) {
            $variationIds = ProductVariationCombination::whereIn('variation_id', $variationIds)
                ->where('attribute_id', $variation['attribute_id'])
                ->where('attribute_value_id', $variation['attribute_value_id'])
                ->pluck('variation_id');

            if ($variationIds->isEmpty()) {
                return false;
            }
        }

        // If we get here, all attribute-value pairs matched an existing variation
        return ProductVariation::with('combinations')
            ->find($variationIds->first());
    }

    public function getById(int $id)
    {
        try {
            $data = ProductVariation::where('id', $id)
                ->with('product', 'combinations', )
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

    public function update(array $array)
    {
        DB::beginTransaction();

        try {
            $data = $this->getById($array['id']);

            if ($data['code'] == 200) {

                // dd($array);
                // dd($data['data']->id);

                if (!empty($array['variation_identifier'])) $data['data']->variation_identifier = $array['variation_identifier'];
                if (!empty($array['sku']))                  $data['data']->sku = $array['sku'];
                if (!empty($array['barcode']))              $data['data']->barcode = $array['barcode'];

                $data['data']->track_quantity = $array['track_quantity'];
                $data['data']->stock_quantity = $array['stock_quantity'];
                $data['data']->allow_backorders = $array['allow_backorders'];

                if (!empty($array['primary_image_id']))     $data['data']->primary_image_id = $array['primary_image_id'];
                // if (!empty($array['price_adjustment']))     $data['data']->price_adjustment = $array['price_adjustment'];
                // if (!empty($array['adjustment_type']))      $data['data']->adjustment_type = $array['adjustment_type'];

                if (!empty($array['weight_adjustment']))    $data['data']->weight_adjustment = $array['weight_adjustment'];
                if (!empty($array['height_adjustment']))    $data['data']->height_adjustment = $array['height_adjustment'];
                if (!empty($array['width_adjustment']))     $data['data']->width_adjustment = $array['width_adjustment'];
                if (!empty($array['length_adjustment']))    $data['data']->length_adjustment = $array['length_adjustment'];
                if (!empty($array['weight_unit']))          $data['data']->weight_unit = $array['weight_unit'];
                if (!empty($array['dimension_unit']))       $data['data']->dimension_unit = $array['dimension_unit'];
                if (!empty($array['is_default']))           $data['data']->is_default = $array['is_default'];
                if (!empty($array['status']))               $data['data']->status = $array['status'];

                $data['data']->save();

                // IMAGES
                if (!empty($array['images']) && count($array['images']) > 0) {
                    foreach($array['images'] as $imageKey => $singleImage) {
                        $uploadResp = fileUpload($singleImage, 'p-img');

                        $imageData = [
                            'product_id' => $data['data']->product_id,
                            'product_variation_id' => $array['id'],
                            'is_variation_specific' => 1,
                            'image_s' => $uploadResp['smallThumbName'],
                            'image_m' => $uploadResp['mediumThumbName'],
                            'image_l' => $uploadResp['largeThumbName'],
                        ];
                        $imageResp = $this->productImageRepository->store($imageData);
                    }
                }

                if (count($array['pricing']) > 0) {
                    // dd($array['pricing']);
                    foreach ($array['pricing'] as $key => $pricing) {

                        // dd($pricing);

                        $pricingData = [
                            'product_id' => $data['data']->product_id,
                            'product_variation_id' => $data['data']->id,
                            'country_code' => $pricing['country_code'],
                            'selling_price' => $pricing['selling_price'],
                            'mrp' => $pricing['mrp'],
                            'discount' => $pricing['discount_percentage'],
                            'cost' => $pricing['cost'],
                            'profit' => $pricing['profit'],
                            'margin' => $pricing['margin_percentage'],
                        ];

                        // dd($pricing, $pricingData);

                        // Update Existing Pricing
                        if (!empty($pricing['id'])) {
                            // dd('here');
                            $pricingResp = $this->productPricingRepository->update($pricing['id'], $pricingData);
                        }
                        // Add New Pricing
                        else {
                            $pricingResp = $this->productPricingRepository->store($pricingData);
                        }

                        // dd($pricingResp);
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
            DB::rollback();

            return [
                'code' => 500,
                'status' => 'error',
                // 'message' => 'An error occurred while updating data.',
                'message' => $e->getMessage(),
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
                    'model' => 'ProductVariation',
                    'table_name' => 'product_variations',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => $data['data']->image_s,
                    'title' => $data['data']->variation_identifier,
                    'description' => $data['data']->variation_identifier.' data deleted from product variations table',
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
            $data = ProductVariation::whereIn('id', $array['ids'])->get();
            if ($array['action'] == 'delete') {
                $data->each(function ($item) {
                    // Handling trash
                    $this->trashRepository->store([
                        'model' => 'ProductVariation',
                        'table_name' => 'product_variations',
                        'deleted_row_id' => $item->id,
                        'thumbnail' => $item->image_s,
                        'title' => $item->title,
                        'description' => $item->title.' data deleted from product variation attributes table',
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
            // $processedCount = saveToDatabase($data, 'ProductVariation');

            // save into Database
            $processedCount = 0;

            foreach ($data as $item) {
                if (!isset($item['title'])) {
                    continue; // Skip rows without a title
                }

                $createdData = ProductVariation::create([
                    'title' => $item['title'] ? $item['title'] : null,
                    'slug' => !empty($item['title']) ? Str::slug($item['title']) : null,
                    'is_global' => !empty($item['is_global']) ? $item['is_global'] : 0,
                    'short_description' => !empty($item['short_description']) ? $item['short_description'] : null,
                    'long_description' => !empty($item['long_description']) ? $item['long_description'] : null,
                    'tags' => !empty($item['tags']) ? $item['tags'] : null,
                    'position' => !empty($item['position']) ? $item['position'] : 1,
                    'status' => !empty($item['status']) ? $item['status'] : 0
                ]);

                // attribute values
                if (!empty($item['values']) && count($createdData->values) == 0) {
                    $explodedValues = array_map('trim', explode(',', $item['values']));

                    foreach ($explodedValues as $key => $singleValue) {
                        $dd = $this->productVariationAttributeValueRepository->store([
                            'attribute_id' => $createdData->id,
                            'title' => $singleValue
                        ]);
                    }
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

    public function export(?String $keyword = '', array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc', String $type)
    {
        try {
            $data = $this->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

            if (count($data['data']) > 0) {
                $fileName = "product_variations_export_" . date('Y-m-d') . '-' . time();

                if ($type == 'excel') {
                    $fileExtension = ".xlsx";
                    return Excel::download(new ProductVariationAttributesExport($data['data']), $fileName.$fileExtension);
                }
                elseif ($type == 'csv') {
                    $fileExtension = ".csv";
                    return Excel::download(new ProductVariationAttributesExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::CSV);
                }
                elseif ($type == 'html') {
                    $fileExtension = ".html";
                    return Excel::download(new ProductVariationAttributesExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::HTML);
                }
                elseif ($type == 'pdf') {
                    $fileExtension = ".pdf";
                    return Excel::download(new ProductVariationAttributesExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::TCPDF);
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

    public function position(array $ids)
    {
        try {
            foreach ($ids as $index => $id) {
                ProductVariation::where('id', $id)->update([
                    'position' => $index + 1
                ]);
            }

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Position updated'
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while positioning data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function groupedVariation(int $id)
    {
        try {
            $data = ProductVariation::with(['combinations.attribute', 'combinations.attributeValue'])
                ->where([
                    ['product_id', $id],
                    ['status', 1]
                ])
                ->orderBy('position', 'asc')
                ->get()
                ->flatMap(function ($variation) {
                    return $variation->combinations->map(function ($combo) use ($variation) {
                        return [
                            // Attribute details
                            'attribute_id' => $combo->attribute->id,
                            'attribute_title' => $combo->attribute->title,
                            'attribute_slug' => $combo->attribute->slug,

                            // Value details
                            'value_id' => $combo->attribute_value_id,
                            'value_title' => $combo->attributeValue->title ?? 'N/A',
                            'value_slug' => $combo->attributeValue->slug ?? 'n-a',
                        ];
                    });
                })
                ->groupBy('attribute_id')
                ->map(function ($group) {
                    $firstItem = $group->first();

                    return [
                        'id' => $firstItem['attribute_id'],
                        'title' => $firstItem['attribute_title'],
                        'slug' => $firstItem['attribute_slug'],
                        'values' => $group->unique('value_id')
                            ->map(function ($item) {
                                return [
                                    'id' => $item['value_id'],
                                    'title' => $item['value_title'],
                                    'slug' => $item['value_slug'],
                                ];
                            })
                            ->sortBy('title')
                            ->values()
                            ->toArray()
                    ];
                })
                ->values()
                ->toArray();

            if (count($data) > 0) {
                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Variations found',
                    'data' => $data
                ];
            } else {
                return [
                    'code' => 404,
                    'status' => 'failure',
                    'message' => 'Variation not found',
                    'data' => []
                ];
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while positioning data.',
                'error' => $e->getMessage(),
            ];
        }
    }
}
