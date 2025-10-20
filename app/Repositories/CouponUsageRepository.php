<?php

namespace App\Repositories;

use App\Interfaces\CouponUsageInterface;
use App\Models\CouponUsage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

use App\Exports\ProductListingsExport;
use Maatwebsite\Excel\Facades\Excel;

class CouponUsageRepository implements CouponUsageInterface
{
    private TrashInterface $trashRepository;

    public function __construct(
        TrashInterface $trashRepository
    )
    {
        $this->trashRepository = $trashRepository;
    }

    public function list(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = CouponUsage::query();

            // keyword
            if (!empty($keyword)) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('slug', 'like', '%' . $keyword . '%')
                        ->orWhere('short_description', 'like', '%' . $keyword . '%')
                        ->orWhere('long_description', 'like', '%' . $keyword . '%')
                        ->orWhere('search_tags', 'like', '%' . $keyword . '%');
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

    public function getUserCouponUsageCount(int $couponId, int $userId)
    {
        $data = CouponUsage::where('coupon_id', $couponId)
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->count();

        if ($data > 0) {
            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data found',
                'count' => $data,
            ];
        } else {
            return [
                'code' => 404,
                'status' => 'failure',
                'message' => 'No data found',
                'count' => $data,
            ];
        }
    }

    public function store(Array $array)
    {
        // dd($array);

        DB::beginTransaction();

        try {
            // product listing
            $data = new CouponUsage();
            $data->coupon_id = $array['coupon_id'];
            $data->user_id = $array['user_id'];
            $data->order_id = $array['order_id'];
            $data->coupon_discount_amount = $array['coupon_discount_amount'];
            $data->coupon_snapshot = $array['coupon_snapshot'];
            $data->ip_address = $array['ip_address'];
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

}
