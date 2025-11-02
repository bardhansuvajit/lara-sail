<?php

namespace App\Repositories;

use App\Interfaces\OrderShippingTrackingInterface;
use App\Models\OrderShippingTracking;
use Illuminate\Support\Facades\DB;

class OrderShippingTrackingRepository implements OrderShippingTrackingInterface
{
    public function list(?string $keyword = '', array $filters = [], string $perPage, string $sortBy = 'id', string $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = OrderShippingTracking::query();

            // keyword
            if (!empty($keyword)) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('carrier', 'like', '%' . $keyword . '%')
                        ->orWhere('tracking_number', 'like', '%' . $keyword . '%')
                        ->orWhere('tracking_url', 'like', '%' . $keyword . '%')
                        ->orWhere('status', 'like', '%' . $keyword . '%')
                        ->orWhere('status_details', 'like', '%' . $keyword . '%');
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
            ? $query->orderBy($sortBy, $sortOrder)->paginate($perPage)->sithQueryString()
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
        DB::beginTransaction();

        try {
            $data = new OrderShippingTracking();
            $data->order_id = $array['order_id'];
            $data->carrier = $array['carrier'];
            $data->tracking_number = $array['tracking_number'];
            $data->tracking_url = $array['tracking_url'];
            $data->status = $array['status'];
            $data->status_details = $array['status_details'];
            $data->shipped_at = $array['shipped_at'];
            $data->estimated_delivery_at = $array['estimated_delivery_at'];
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
                // 'message' => 'An error occurred while storing data.',
                'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getByOrderId(Int $orderId)
    {
        try {
            $data = OrderShippingTracking::find($orderId);

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

    public function exists(array $conditions)
    {
        try {
            $data = OrderShippingTracking::where($conditions)->get();

            if (count($data) > 0 ) {
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

}
