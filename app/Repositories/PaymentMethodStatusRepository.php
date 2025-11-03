<?php

namespace App\Repositories;

use App\Interfaces\PaymentMethodStatusInterface;
use App\Models\PaymentMethodStatus;
use Illuminate\Support\Facades\DB;

class PaymentMethodStatusRepository implements PaymentMethodStatusInterface
{
    public function list(?string $keyword = '', array $filters = [], string $perPage, string $sortBy = 'id', string $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = PaymentMethodStatus::query();

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

    public function exists(array $conditions)
    {
        try {
            $data = PaymentMethodStatus::where($conditions)->get();

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
