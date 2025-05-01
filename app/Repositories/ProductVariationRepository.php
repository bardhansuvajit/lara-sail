<?php

namespace App\Repositories;

use App\Interfaces\ProductVariationInterface;
use App\Models\ProductVariation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;
use App\Interfaces\ProductVariationCombinationInterface;
use App\Models\ProductVariationCombination;

use App\Exports\ProductVariationAttributesExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductVariationRepository implements ProductVariationInterface
{
    private TrashInterface $trashRepository;
    private ProductVariationCombinationInterface $productVariationCombinationRepository;

    public function __construct(TrashInterface $trashRepository, ProductVariationCombinationInterface $productVariationCombinationRepository)
    {
        $this->trashRepository = $trashRepository;
        $this->productVariationCombinationRepository = $productVariationCombinationRepository;
    }

    public function list(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
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

    public function store(Array $array)
    {
        // dd($array);

        DB::beginTransaction();

        try {
            // Check if this variation combination already exists for this product
            if (!empty($array['variations']) && count($array['variations']) > 0) {
                $existingVariation = $this->checkExistingVariation(
                    $array['product_id'],
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
            $data->product_id = $array['product_id'];
            $data->variation_identifier = $variationIdentifier;
            $data->sku = !empty($array['sku']) ? $array['sku'] : null;
            $data->barcode = !empty($array['barcode']) ? $array['barcode'] : null;
            $data->track_quantity = !empty($array['track_quantity']) ? $array['track_quantity'] : 0;
            $data->stock_quantity = !empty($array['stock_quantity']) ? $array['stock_quantity'] : 0;
            $data->allow_backorders = !empty($array['allow_backorders']) ? $array['allow_backorders'] : 0;
            $data->sold_count = !empty($array['sold_count']) ? $array['sold_count'] : 0;
            $data->in_cart_count = !empty($array['in_cart_count']) ? $array['in_cart_count'] : 0;
            $data->primary_image_id = !empty($array['primary_image_id']) ? $array['primary_image_id'] : null;
            $data->price_adjustment = !empty($array['price_adjustment']) ? $array['price_adjustment'] : 0;
            $data->adjustment_type = !empty($array['adjustment_type']) ? $array['adjustment_type'] : 'fixed';
            $data->weight_adjustment = !empty($array['weight_adjustment']) ? $array['weight_adjustment'] : 0;
            $data->height_adjustment = !empty($array['height_adjustment']) ? $array['height_adjustment'] : 0;
            $data->width_adjustment = !empty($array['width_adjustment']) ? $array['width_adjustment'] : 0;
            $data->length_adjustment = !empty($array['length_adjustment']) ? $array['length_adjustment'] : 0;
            $data->weight_unit = !empty($array['weight_unit']) ? $array['weight_unit'] : 'g';
            $data->dimension_unit = !empty($array['dimension_unit']) ? $array['dimension_unit'] : 'cm';
            $data->is_default = !empty($array['is_default']) ? $array['is_default'] : 0;
            $data->status = !empty($array['status']) ? $array['status'] : 1;
            $data->save();

            if (!empty($array['variations']) && count($array['variations']) > 0) {
                // $explodedValues = array_map('trim', explode(',', $array['values']));

                foreach ($array['variations'] as $key => $variation) {
                    $this->productVariationCombinationRepository->store([
                        'variation_id' => $data->id,
                        'attribute_id' => $variation['attribute_id'],
                        'attribute_value_id' => $variation['attribute_value_id'],
                    ]);
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

    public function getById(Int $id)
    {
        try {
            $data = ProductVariation::find($id);

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
        DB::beginTransaction();

        try {
            $data = $this->getById($array['id']);

            if ($data['code'] == 200) {
                $data['data']->title = $array['title'];
                $data['data']->slug = Str::slug($array['title']);
                $data['data']->is_global = $array['is_global'] ? $array['is_global'] : 0;
                $data['data']->short_description = isset($array['short_description']) ? $array['short_description'] : null;
                $data['data']->long_description = isset($array['long_description']) ? $array['long_description'] : null;
                $data['data']->tags = isset($array['tags']) ? $array['tags'] : null;
                $data['data']->save();

                DB::commit();

                if (!empty($array['values']) && count($data['data']->values) == 0) {
                    $explodedValues = array_map('trim', explode(',', $array['values']));

                    foreach ($explodedValues as $key => $singleValue) {
                        $dd = $this->productVariationAttributeValueRepository->store([
                            'attribute_id' => $array['id'],
                            'title' => $singleValue
                        ]);
                    }
                }

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

    public function bulkAction(Array $array)
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

    public function export(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc', String $type)
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

    public function position(Array $ids)
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
}
