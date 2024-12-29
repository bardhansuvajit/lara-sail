<?php

namespace App\Repositories;

use App\Interfaces\ProductCategoryInterface;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Str;
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
        $data->slug = \Str::slug($array['title']);
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
}
