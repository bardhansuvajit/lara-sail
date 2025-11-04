<?php

namespace App\Repositories;

use App\Interfaces\ProductFeatureInterface;
use App\Models\ProductFeature;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;

class ProductFeatureRepository implements ProductFeatureInterface
{
    private TrashInterface $trashRepository;

    public function __construct(TrashInterface $trashRepository)
    {
        $this->trashRepository = $trashRepository;
    }

    public function list(?String $keyword = '', array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = ProductFeature::query();

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
            ? $query->orderBy($sortBy, $sortOrder)->with('product')->paginate($perPage)->withQueryString()
            : $query->orderBy($sortBy, $sortOrder)->with('product')->get();

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

    public function listAllFeatured() {
        $types = ['featured', 'flash', 'trending', 'search'];
        $results = [];

        $products = ProductFeature::with(['product.activeImages', 'product.pricings'])
            ->whereIn('type', $types)
            ->orderBy('position', 'asc')
            ->get()
            ->groupBy('type');

        foreach ($types as $type) {
            $results[$type] = $products->get($type, collect())->pluck('product');
        }

        if (count($products) > 0) {
            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data found',
                'data' => $results,
            ];
        } else {
            return [
                'code' => 404,
                'status' => 'failure',
                'message' => 'No data found',
                'data' => [],
            ];
        }

        // return ['data' => $results];
    }

    public function listFeaturedOnly(string $type) {
        // $types = ['featured', 'flash', 'trending', 'search'];
        // $results = [];

        $products = ProductFeature::with(['product.activeImages', 'product.pricings'])
            ->where('type', $type)
            ->orderBy('position', 'asc')
            ->get();
            // ->groupBy('type');

        // foreach ($types as $type) {
        //     $results[$type] = $products->get($type, collect())->pluck('product');
        // }

        if (count($products) > 0) {
            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data found',
                'data' => $products,
            ];
        } else {
            return [
                'code' => 404,
                'status' => 'failure',
                'message' => 'No data found',
                'data' => [],
            ];
        }

        // return ['data' => $results];
    }

    public function getById(int $id)
    {
        try {
            $data = ProductFeature::find($id);

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

    public function getByProductId(int $productId)
    {
        try {
            $data = ProductFeature::where('product_id', $productId)->first();

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

    
    public function store(array $array)
    {
        // dd($array);

        DB::beginTransaction();

        try {
            $data = new ProductFeature();
            $data->product_id = $array['product_id'];

            // get max position
            $lastPosition = ProductFeature::where('type', $array['type'])->max('position');
            $data->position = $lastPosition ? $lastPosition + 1 : 1;

            $data->status = 1;
            $data->type = $array['type'];
            $data->save();

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
                'message' => 'An error occurred while storing data.',
                // 'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }

    public function update(int $id, array $array)
    {
        // dd($id, $array);

        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                $data['data']->type = $array['type'];
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

    public function delete(int $id)
    {
        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                // Handling trash
                $trashData = $this->trashRepository->store([
                    'model' => 'ProductFeature',
                    'table_name' => 'product_features',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => $data['data']->image_s ?? null,
                    'title' => $data['data']->product->title,
                    'description' => $data['data']->product->title.' FEATURE data deleted from product_features table',
                    'status' => 'deleted',
                ]);

                // dd($trashData);

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

    public function position(array $ids)
    {
        try {
            foreach ($ids as $index => $id) {
                ProductFeature::where('id', $id)->update([
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
