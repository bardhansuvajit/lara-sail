<?php

namespace App\Repositories;

use App\Interfaces\ProductCategoryInterface;
use App\Models\ProductCategory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

use App\Exports\ProductCategoriesExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductCategoryRepository implements ProductCategoryInterface
{
    private TrashInterface $trashRepository;

    public function __construct(TrashInterface $trashRepository)
    {
        $this->trashRepository = $trashRepository;
    }

    public function list(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = ProductCategory::query();

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
        // dd($array['image']);
        try {
            $data = new ProductCategory();
            $data->title = $array['title'];
            $data->slug = Str::slug($array['title']);
            $data->parent_id = $array['parent_id'] ?? null;
            $data->level = $array['level'];

            $data->short_description = $array['short_description'] ?? null;
            $data->long_description = $array['long_description'] ?? null;

            if (!empty($array['image'])) {
                $uploadResp = fileUpload($array['image'], 'p-cat');

                $data->image_s = $uploadResp['smallThumbName'];
                $data->image_m = $uploadResp['mediumThumbName'];
                $data->image_l = $uploadResp['largeThumbName'];
            }

            // get max position for given attribute_id and type
            $lastPosition = ProductCategory::max('position');
            $data->position = $lastPosition ? $lastPosition + 1 : 1;

            $data->status = 0;

            $data->save();

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Changes have been saved',
                'data' => $data,
            ];
        } catch (\Exception $e) {
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
            $data = ProductCategory::find($id);

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

    public function getBySlug(String $slug)
    {
        try {
            $data = ProductCategory::where('slug', $slug)->first();

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
        try {
            $data = $this->getById($array['id']);

            if ($data['code'] == 200) {
                $data['data']->title = $array['title'];
                $data['data']->slug = \Str::slug($array['title']);
                $data['data']->level = $array['level'];
                $data['data']->parent_id = $array['parent_id'] ?? null;

                $data['data']->short_description = $array['short_description'] ?? null;
                $data['data']->long_description = $array['long_description'] ?? null;

                if (!empty($array['image'])) {
                    $uploadResp = fileUpload($array['image'], 'p-cat');

                    $data['data']->image_s = $uploadResp['smallThumbName'];
                    $data['data']->image_m = $uploadResp['mediumThumbName'];
                    $data['data']->image_l = $uploadResp['largeThumbName'];
                }

                $data['data']->save();

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
                    'model' => 'ProductCategory',
                    'table_name' => 'product_categories',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => $data['data']->image_s,
                    'title' => $data['data']->title,
                    'description' => $data['data']->title.' data deleted from product categories table',
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
            $data = ProductCategory::whereIn('id', $array['ids'])->get();
            if ($array['action'] == 'delete') {
                $data->each(function ($item) {
                    // Handling trash
                    $this->trashRepository->store([
                        'model' => 'ProductCategory',
                        'table_name' => 'product_categories',
                        'deleted_row_id' => $item->id,
                        'thumbnail' => $item->image_s,
                        'title' => $item->title,
                        'description' => $item->title.' data deleted from product categories table',
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
            'created'   => 0,
            'skipped'   => 0,
            'failed'    => 0,
            'errors'    => [],
            'skipped_rows' => [],
        ];

        $toIntOrNull = fn($v) => ($v === '' || $v === null) ? null : (int)$v;

        try {
            $filePath = fileStore($file);
            $rows = readCsvFile(public_path($filePath)); // array of assoc rows

            foreach ($rows as $i => $row) {
                $summary['processed']++;

                $title = trim(Arr::get($row, 'title', ''));
                if ($title === '') {
                    $summary['failed']++;
                    $summary['errors'][] = ['row' => $i + 1, 'reason' => 'missing title'];
                    continue;
                }

                try {
                    DB::beginTransaction();

                    // Check if already exists
                    $slug = Str::slug(Arr::get($row, 'slug', $title));
                    $existing = ProductCategory::where('slug', $slug)->first();

                    if ($existing) {
                        $summary['skipped']++;
                        $summary['skipped_rows'][] = $i + 1;
                        DB::rollBack(); // no changes
                        continue;
                    }

                    // Get next position (could also scope by parent_id if needed)
                    $lastPosition = ProductCategory::max('position') ?? 0;

                    ProductCategory::create([
                        'title'             => $title,
                        'slug'              => $slug,
                        'parent_id'         => $toIntOrNull(Arr::get($row, 'parent_id')),
                        'level'             => $toIntOrNull(Arr::get($row, 'level')),
                        'short_description' => Arr::get($row, 'short_description') ?: null,
                        'long_description'  => Arr::get($row, 'long_description') ?: null,
                        'tags'              => Arr::get($row, 'tags') ?: null,
                        'meta_title'        => Arr::get($row, 'meta_title') ?: null,
                        'meta_desc'         => Arr::get($row, 'meta_desc') ?: null,
                        'status'            => $toIntOrNull(Arr::get($row, 'status', 0)) ?? 0,
                        'position'          => $toIntOrNull(Arr::get($row, 'position', $lastPosition + 1)),
                    ]);

                    DB::commit();
                    $summary['created']++;
                } catch (\Throwable $e) {
                    DB::rollBack();
                    $summary['failed']++;
                    $summary['errors'][] = [
                        'row'    => $i + 1,
                        'reason' => $e->getMessage(),
                    ];
                    Log::error("Category import row ".($i+1)." failed: ".$e->getMessage());
                    continue;
                }
            }

            return [
                'code'    => 200,
                'status'  => 'success',
                'message' => "{$summary['created']} / {$summary['processed']} processed. {$summary['skipped']} skipped, {$summary['failed']} failed.",
                'data'    => $summary,
            ];
        } catch (\Throwable $e) {
            Log::error('CSV Category Import Error: ' . $e->getMessage());
            return [
                'code'    => 500,
                'status'  => 'error',
                'message' => 'Import failed: ' . $e->getMessage(),
                'error'   => $e->getMessage(),
            ];
        }
    }

    public function importOld(UploadedFile $file)
    {
        try {
            $filePath = fileStore($file);
            $data = readCsvFile(public_path($filePath));
            // $processedCount = saveToDatabase($data, 'ProductCategory');

            // save into Database
            $processedCount = 0;

            foreach ($data as $item) {
                if (!isset($item['title'])) {
                    continue; // Skip rows without a title
                }

                // get max position for given attribute_id and type
                $lastPosition = ProductCategory::max('position');

                // dd($item['parent_id']);

                ProductCategory::create([
                    'title' => $item['title'] ? $item['title'] : null,
                    'slug' => !empty($item['title']) ? Str::slug($item['title']) : null,
                    'parent_id' => !empty($item['parent_id']) ? $item['parent_id'] : null,
                    'level' => !empty($item['level']) ? $item['level'] : null,
                    'short_description' => !empty($item['short_description']) ? $item['short_description'] : null,
                    'long_description' => !empty($item['long_description']) ? $item['long_description'] : null,
                    'tags' => !empty($item['tags']) ? $item['tags'] : null,
                    'meta_title' => !empty($item['meta_title']) ? $item['meta_title'] : null,
                    'meta_desc' => !empty($item['meta_desc']) ? $item['meta_desc'] : null,
                    'status' => 0,
                    'position' => $lastPosition ? $lastPosition + 1 : 1
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
                $fileName = "product_categories_export_" . date('Y-m-d') . '-' . time();

                if ($type == 'excel') {
                    $fileExtension = ".xlsx";
                    return Excel::download(new ProductCategoriesExport($data['data']), $fileName.$fileExtension);
                }
                elseif ($type == 'csv') {
                    $fileExtension = ".csv";
                    return Excel::download(new ProductCategoriesExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::CSV);
                }
                elseif ($type == 'html') {
                    $fileExtension = ".html";
                    return Excel::download(new ProductCategoriesExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::HTML);
                }
                elseif ($type == 'pdf') {
                    $fileExtension = ".pdf";
                    return Excel::download(new ProductCategoriesExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::TCPDF);
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
                ProductCategory::where('id', $id)->update([
                    'position' => $index + 1
                ]);
            }
            ProductCategory::clearActiveCategoriesCache();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Position updated'
            ]);
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
