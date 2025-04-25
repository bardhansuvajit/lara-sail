<?php

namespace App\Repositories;

use App\Interfaces\ProductVariationAttributeValueInterface;
use App\Models\ProductVariationAttributeValue;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;
use App\Interfaces\ProductCategoryVariationAttributeInterface;

use App\Exports\ProductVariationAttributeValuesExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductVariationAttributeValueRepository implements ProductVariationAttributeValueInterface
{
    private TrashInterface $trashRepository;
    private ProductCategoryVariationAttributeInterface $productCategoryVariationAttributeRepository;

    public function __construct(TrashInterface $trashRepository, ProductCategoryVariationAttributeInterface $productCategoryVariationAttributeRepository)
    {
        $this->trashRepository = $trashRepository;
        $this->productCategoryVariationAttributeRepository = $productCategoryVariationAttributeRepository;
    }

    public function list(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = ProductVariationAttributeValue::query();

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
            ? $query->orderBy($sortBy, $sortOrder)->with('attribute', 'categoryAttributes', 'categories')->paginate($perPage)->withQueryString()
            : $query->orderBy($sortBy, $sortOrder)->with('attribute', 'categoryAttributes', 'categories')->get();

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
        // dd($array['image']);
        DB::beginTransaction();

        try {
            $data = new ProductVariationAttributeValue();
            $data->attribute_id = $array['attribute_id'];
            $data->title = $array['title'];
            $data->slug = Str::slug($array['title']);
            $data->meta = !empty($array['meta']) ? $array['meta'] : null;

            // get max position for given attribute_id and type
            $lastPosition = ProductVariationAttributeValue::where('attribute_id', $array['attribute_id'])
            ->where('type', !empty($array['type']) ? $array['type'] : 1)
            ->max('position');
            $data->position = $lastPosition ? $lastPosition + 1 : 1;

            $data->type = !empty($array['type']) ? $array['type'] : 1;
            $data->short_description = !empty($array['short_description']) ? $array['short_description'] : null;
            $data->long_description = !empty($array['long_description']) ? $array['long_description'] : null;
            $data->tags = !empty($array['tags']) ? $array['tags'] : null;
            $data->status = !empty($array['status']) ? $array['status'] : 1;
            $data->save();

            // category
            if (!empty($array['category_id'])) {
                $category_ids = explode(',', $array['category_id']);
                foreach ($category_ids as $category_key => $category_id) {
                    $category_id = trim($category_id);

                    if ($category_id !== '') {
                        $exists = $this->productCategoryVariationAttributeRepository->exists([
                            'category_id' => $category_id,
                            'attribute_value_id' => $data->id
                        ]);

                        if ($exists['code'] == 404) {
                            $this->productCategoryVariationAttributeRepository->store([
                                'category_id' => $category_id,
                                'attribute_value_id' => $data->id
                            ]);
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

    public function getById(Int $id)
    {
        try {
            $data = ProductVariationAttributeValue::find($id);

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
                $data['data']->attribute_id = $array['attribute_id'];
                $data['data']->title = $array['title'];
                $data['data']->slug = Str::slug($array['title']);
                $data['data']->meta = isset($array['meta']) ? $array['meta'] : null;
                $data['data']->type = isset($array['type']) ? $array['type'] : 1;
                $data['data']->short_description = isset($array['short_description']) ? $array['short_description'] : null;
                $data['data']->long_description = isset($array['long_description']) ? $array['long_description'] : null;
                $data['data']->tags = isset($array['tags']) ? $array['tags'] : null;
                $data['data']->status = isset($array['status']) ? $array['status'] : 1;
                $data['data']->save();

                // category
                if (!empty($array['category_id'])) {
                    $category_ids = array_map('intval', explode(',', $array['category_id']));
                    $attrValueExistData = $this->productCategoryVariationAttributeRepository->exists([
                        'attribute_value_id' => $data['data']->id
                    ]);
                
                    if ($attrValueExistData['code'] == 200) {
                        // Get existing category IDs
                        $existingCategories = $attrValueExistData['data']->pluck('category_id')->toArray();
                        
                        // Find categories to remove (exist in DB but not in new list)
                        $categoriesToRemove = array_diff($existingCategories, $category_ids);
                        
                        if (!empty($categoriesToRemove)) {
                            // Get IDs of records to delete
                            $recordsToDelete = $attrValueExistData['data']
                                ->whereIn('category_id', $categoriesToRemove)
                                ->pluck('id')
                                ->toArray();
                                
                            $deleteChk = $this->productCategoryVariationAttributeRepository->bulkAction([
                                'ids' => $recordsToDelete,
                                'action' => 'delete'
                            ]);
                        }
                        
                        // Find categories to add (exist in new list but not in DB)
                        $categoriesToAdd = array_diff($category_ids, $existingCategories);
                        foreach ($categoriesToAdd as $category_id) {
                            $this->productCategoryVariationAttributeRepository->store([
                                'category_id' => $category_id,
                                'attribute_value_id' => $data['data']->id
                            ]);
                        }
                    } else {
                        // Original code for when no existing records are found
                        foreach ($category_ids as $category_id) {
                            $category_id = trim($category_id);
                            if ($category_id !== '') {
                                $this->productCategoryVariationAttributeRepository->store([
                                    'category_id' => $category_id,
                                    'attribute_value_id' => $data['data']->id
                                ]);
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

    public function delete(Int $id)
    {
        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                // Handling trash
                $this->trashRepository->store([
                    'model' => 'ProductVariationAttributeValue',
                    'table_name' => 'product_variation_attribute_values',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => $data['data']->image_s,
                    'title' => $data['data']->title,
                    'description' => $data['data']->title.' data deleted from product variation attributes table',
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
            $data = ProductVariationAttributeValue::whereIn('id', $array['ids'])->get();
            if ($array['action'] == 'delete') {
                $data->each(function ($item) {
                    // Handling trash
                    $this->trashRepository->store([
                        'model' => 'ProductVariationAttributeValue',
                        'table_name' => 'product_variation_attribute_values',
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
            // $processedCount = saveToDatabase($data, 'ProductVariationAttributeValue');

            // save into Database
            $processedCount = 0;

            foreach ($data as $item) {
                if (!isset($item['title']) && !isset($item['attribute_id'])) {
                    continue; // Skip rows without a title
                }

                ProductVariationAttributeValue::create([
                    'attribute_id' => $item['attribute_id'] ? $item['attribute_id'] : null,
                    'title' => $item['title'] ? $item['title'] : null,
                    'slug' => !empty($item['slug']) ? Str::slug($item['title']) : null,
                    'meta' => !empty($item['meta']) ? $item['meta'] : null,
                    'type' => !empty($item['type']) ? $item['type'] : null,
                    'short_description' => !empty($item['short_description']) ? $item['short_description'] : null,
                    'long_description' => !empty($item['long_description']) ? $item['long_description'] : null,
                    'tags' => !empty($item['tags']) ? $item['tags'] : null,
                    'position' => !empty($item['position']) ? $item['position'] : 1,
                    'status' => !empty($item['status']) ? $item['status'] : 0
                ]);

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
                $fileName = "product_variation_attribute_values_export_" . date('Y-m-d') . '-' . time();

                if ($type == 'excel') {
                    $fileExtension = ".xlsx";
                    return Excel::download(new ProductVariationAttributeValuesExport($data['data']), $fileName.$fileExtension);
                }
                elseif ($type == 'csv') {
                    $fileExtension = ".csv";
                    return Excel::download(new ProductVariationAttributeValuesExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::CSV);
                }
                elseif ($type == 'html') {
                    $fileExtension = ".html";
                    return Excel::download(new ProductVariationAttributeValuesExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::HTML);
                }
                elseif ($type == 'pdf') {
                    $fileExtension = ".pdf";
                    return Excel::download(new ProductVariationAttributeValuesExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::TCPDF);
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
                ProductVariationAttributeValue::where('id', $id)->update([
                    'position' => $index + 1
                ]);
            }

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Position updated'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while positioning data.',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
