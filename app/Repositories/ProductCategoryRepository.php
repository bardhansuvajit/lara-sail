<?php

namespace App\Repositories;

use App\Interfaces\ProductCategoryInterface;
use App\Models\ProductCategory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductCategoryRepository implements ProductCategoryInterface
{
    public function list(?string $keyword = '', array $filters = [], int $perPage = 15, string $sortBy = 'id', string $sortOrder = 'asc') : array
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

            /*
            // keyword
            if (!empty($filters)) {
                foreach ($filters as $field => $value) {
                    if (!is_null($value) && $value !== '') {
                        if (is_array($value)) {
                            // For multiple values
                            $query->whereIn($field, $value);
                        } else {
                            // Basic where clause
                            $query->where($field, '=', $value);
                        }
                    }
                }
            }
            */

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

            /*
            // page
            if ($perPage !== 'all') {
                $data = $query
                ->orderBy($sortBy, $sortOrder)
                ->paginate($perPage)
                ->withQueryString();
            } else {
                $data = $query
                ->orderBy($sortBy, $sortOrder)
                ->get()
                ->withQueryString();
            }
            */

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
        $data = new ProductCategory();
        $data->title = $array['title'];
        $data->slug = Str::slug($array['title']);
        $data->parent_id = $array['parent_id'];
        $data->level = $array['level'];
        $data->save();

        return [
            'code' => 200,
            'status' => 'success',
            'message' => 'Changes have been saved',
            'data' => $data,
        ];
    }

    public function getById(Int $id)
    {
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
    }

    public function update(Array $array)
    {
        try {
            $data = $this->getById($array['id']);

            if ($data['code'] == 200) {
                $data['data']->title = $array['title'];
                $data['data']->slug = \Str::slug($array['title']);
                $data['data']->parent_id = $array['parent_id'];
                $data['data']->level = $array['level'];
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
            $processedCount = saveToDatabase($data, 'ProductCategory');

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
                'message' => 'An error occurred while uploading data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function export(?string $keyword = '', array $filters = [], int $perPage = 15, string $sortBy = 'id', string $sortOrder = 'asc') : array
    {
        $data = $this->list($keyword, $filters, $perPage, $sortBy, $sortOrder);
        if (count($data['data']) > 0) {
            dd(count($data['data']));
        } else {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while fetching data.',
                'error' => 'Data fetch error',
            ];
        }
    }
}
