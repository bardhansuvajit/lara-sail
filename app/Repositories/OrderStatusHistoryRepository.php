<?php

namespace App\Repositories;

use App\Interfaces\OrderStatusHistoryInterface;
use App\Models\OrderStatusHistory;
use Illuminate\Support\Facades\DB;

class OrderStatusHistoryRepository implements OrderStatusHistoryInterface
{
    public function list(?string $keyword = '', array $filters = [], string $perPage, string $sortBy = 'id', string $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = OrderStatusHistory::query();

            // keyword
            if (!empty($keyword)) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('status', 'like', '%' . $keyword . '%')
                        ->orWhere('previous_status', 'like', '%' . $keyword . '%')
                        ->orWhere('notes', 'like', '%' . $keyword . '%')
                        ->orWhere('metadata', 'like', '%' . $keyword . '%');
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
            // dd($array);

            $data = new OrderStatusHistory();
            $data->type = $array['type'];
            $data->order_id = $array['order_id'];
            $data->status = $array['status'];
            $data->previous_status = $array['previous_status'] ?? null;
            $data->title = $array['title'] ?? null;
            $data->notes = $array['notes'] ?? null;
            $data->show_in_frontend = (bool) $array['show_in_frontend'] ?? false;
            $data->metadata = $array['metadata'] ?? null;
            $data->actor_type = $array['actor_type'];
            $data->actor_id = $array['actor_id'];
            $data->class = $array['class'];
            $data->icon = $array['icon'];
            $data->ip_address = $array['ip_address'] ?? request()->ip();
            $data->user_agent = $array['user_agent'] ?? request()->userAgent();

            // get max position for given attribute_id and type
            $lastPosition = OrderStatusHistory::where('order_id', $array['order_id'])
                ->max('position');
            $position = $lastPosition ? $lastPosition + 1 : 1;
            $data->position = $position;

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

    public function getByOrderId(int $orderId)
    {
        try {
            $data = OrderStatusHistory::find($orderId);

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
            $data = OrderStatusHistory::where($conditions)->get();

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

    public function updateFrontendStat(int $id)
    {
        try {
            $data = OrderStatusHistory::find($id);

            if (!empty($data)) {
                $newStat = ($data->show_in_frontend == false) ? true : false;
                // dd($data->show_in_frontend, $newStat);
                $data->show_in_frontend = $newStat;
                $data->save();

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

    public function position(array $ids)
    {
        try {
            // dd($ids);

            foreach ($ids as $index => $id) {
                $resp = OrderStatusHistory::where('id', $id)->update([
                    'position' => $index + 1
                ]);

                // dd($resp);
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
