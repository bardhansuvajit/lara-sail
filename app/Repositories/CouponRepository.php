<?php

namespace App\Repositories;

use App\Interfaces\CouponInterface;
use App\Models\Coupon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\CartInterface;
use App\Interfaces\TrashInterface;
use App\Interfaces\CouponUsageInterface;
use Illuminate\Support\Facades\Log;

class CouponRepository implements CouponInterface
{
    private CartInterface $cartRepository;
    private TrashInterface $trashRepository;
    private CouponUsageInterface $couponUsageRepository;

    public function __construct(
        CartInterface $cartRepository,
        TrashInterface $trashRepository, 
        CouponUsageInterface $couponUsageRepository
    )
    {
        $this->cartRepository = $cartRepository;
        $this->trashRepository = $trashRepository;
        $this->couponUsageRepository = $couponUsageRepository;
    }

    public function list(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = Coupon::query();

            // keyword
            if (!empty($keyword)) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('code', 'like', '%' . $keyword . '%')
                        ->orWhere('name', 'like', '%' . $keyword . '%')
                        ->orWhere('description', 'like', '%' . $keyword . '%')
                        ->orWhere('discount_type', 'like', '%' . $keyword . '%');
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

    public function listCountryBasedFrontendCoupons(string $country)
    {
        $data = Coupon::where([
                ['country_code', $country],
                ['show_in_frontend', 1]
            ])
            ->orderBy('position')
            ->get();

        return [
            'code' => 200,
            'status' => 'success',
            'message' => 'Data found',
            'data' => $data,
        ];
    }

    public function checkAndApplyToCart(string $couponCode, $cartData)
    {
        try {
            // Check if coupon is empty/ not
            if (trim($couponCode) == '') {
                return [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'Please enter a coupon code',
                ];
            }

            $userId = $cartData->user_id;

            // Check if cart exists & there are items in cart
            // if (!is_null($userId)) {
            //     $cart = $this->cartRepository->exists(['user_id' => $userId]);
            // } else {
            //     $cart = $this->cartRepository->exists(['device_id' => $deviceId]);
            // }

            // Check if cart exists and has items
            // if ($cart['code'] != 200 || empty($cart['data']->items)) {
            //     return [
            //         'success' => false,
            //         'code' => 400,
            //         'status' => 'error',
            //         'message' => 'Your cart is empty! Please add some items to cart first.',
            //     ];
            // }

            // $cartData = $cart['data'];

            // Check if this/ other coupons are already applied
            if (!empty($cartData->coupon_code)) {
                if ($cartData->coupon_code === strtolower(trim($couponCode))) {
                    return [
                        'success' => false,
                        'code' => 400,
                        'status' => 'error',
                        'message' => 'This coupon is already applied to your cart',
                    ];
                } else {
                    return [
                        'success' => false,
                        'code' => 400,
                        'status' => 'error',
                        'message' => 'Another coupon is already applied to your cart ! Please remove it first.',
                    ];
                }
            }

            $coupon = Coupon::where('code', strtolower(trim($couponCode)))
                ->where('status', 1)
                ->where('show_in_frontend', true)
                ->where('starts_at', '<=', now())
                ->where('expires_at', '>=', now())
                ->first();

            if (!$coupon) {
                return [
                    'success' => false,
                    'code' => 404,
                    'status' => 'error',
                    'message' => 'Invalid or expired coupon code',
                ];
            }

            // Check usage limits
            if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
                return [
                    'success' => false,
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'This coupon has reached its usage limit',
                ];
            }

            // dd($coupon);

            // Check per user usage limit
            if ($coupon->usage_per_user) {
                if (!is_null($userId)) {
                    $couponUsageData = $this->couponUsageRepository->getUserCouponUsageCount($coupon->id, $userId);
                    if ($couponUsageData['count'] >= $coupon->usage_per_user) {
                        return [
                            'success' => false,
                            'code' => 400,
                            'status' => 'error',
                            'message' => 'You have already used this coupon the maximum number of times',
                        ];
                    }
                }
            }

            // Check minimum cart value
            // dd($cartData, $coupon);
            $cartTotal = $cartData->total ?? 0;
            if ($coupon->min_cart_value && $cartTotal < $coupon->min_cart_value) {
                $symbol = $cartData->countryDetail->currency_symbol;
                return [
                    'success' => false,
                    'code' => 400,
                    'status' => 'error',
                    'message' => "Minimum cart value required: {$symbol}" . formatIndianMoney($coupon->min_cart_value),
                ];
            }

            // dd('here2222');

            // Calculate discount
            $discountAmount = $this->calculateDiscount($coupon, $cartTotal);

            // dd($discountAmount);

            // Apply coupon to cart (update cart with discount)
            // $applied = $this->applyCouponToCart($coupon, $discountAmount, $userId, $deviceId);
            $applied = $this->applyCouponToCart($cartData->id, $coupon, $discountAmount);

            // dd($applied);

            if (!$applied) {
                return [
                    'success' => false,
                    'code' => 500,
                    'status' => 'error',
                    'message' => 'Failed to apply coupon to cart',
                ];
            }

            // Increment coupon usage
            $this->incrementCouponUsage($coupon->id);

            // Record coupon redemption - Do this on order place
            // $this->recordCouponRedemption($coupon->id, $userId, $deviceId, $discountAmount);

            return [
                'success' => true,
                'code' => 200,
                'status' => 'success',
                'message' => 'Coupon applied successfully!',
                'data' => [
                    'coupon' => $coupon,
                    'coupon_discount_amount' => $discountAmount,
                    'new_total' => $cartTotal - $discountAmount,
                ],
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'Something Happened. Try Again !',
                'error' => $e->getMessage(),
            ];
        }
    }

    private function calculateDiscount($coupon, $cartTotal): float
    {
        // dd($coupon->discount_type);
        return match($coupon->discount_type) {
            'percentage' => $this->calculatePercentageDiscount($coupon, $cartTotal),
            'fixed' => $this->calculateFixedDiscount($coupon, $cartTotal),
            'free_shipping' => 0, // Handle shipping separately
            default => 0,
        };
    }

    private function calculatePercentageDiscount($coupon, $cartTotal): float
    {
        // dd($coupon, $cartTotal);
        $discount = $cartTotal * ($coupon->value / 100);
        
        // Apply max discount limit if set
        if ($coupon->max_discount_amount && $discount > $coupon->max_discount_amount) {
            $discount = $coupon->max_discount_amount;
        }

        return max(0, round($discount, 2));
    }

    private function calculateFixedDiscount($coupon, $cartTotal): float
    {
        // Don't discount more than cart value
        return min($coupon->value, $cartTotal);
    }

    private function applyCouponToCart($cartId, $coupon, float $discountAmount): bool
    {
        try {
            $cartData = [
                'id' => $cartId,
                'coupon_code_id' => $coupon->id,
                'coupon_code' => $coupon->code,
                'coupon_discount_amount' => $discountAmount,
                'coupon_meta' => json_encode([
                    'coupon_id' => $coupon->id,
                    'code' => $coupon->code,
                    'name' => $coupon->name,
                    'description' => $coupon->description,
                    'discount_type' => $coupon->discount_type,
                    'value' => $coupon->value,
                    'max_discount_amount' => $coupon->max_discount_amount,
                    'min_cart_value' => $coupon->min_cart_value,
                    'applied_at' => now()->toISOString(),
                ]),
            ];

            $result = $this->cartRepository->updateCartDiscount($cartData);

            // if ($userId) {
                // $result = $this->cartRepository->updateCartDiscount($userId, null, $cartData);
            // } else {
            //     $result = $this->cartRepository->updateCartDiscount(null, $deviceId, $cartData);
            // }

            return $result['code'] === 200 && $result['status'] === 'success';

        } catch (\Exception $e) {
            logger()->error('Failed to apply coupon to cart: ' . $e->getMessage());
            return false;
        }
    }

    private function incrementCouponUsage(int $couponId): void
    {
        Coupon::where('id', $couponId)->increment('used_count');
    }

    private function recordCouponRedemption(int $couponId, ?int $userId, ?string $deviceId, float $discountAmount): void
    {
        try {
            \App\Models\CouponUsage::create([
                'coupon_id' => $couponId,
                'user_id' => $userId,
                'device_id' => $deviceId,
                'coupon_discount_amount' => $discountAmount,
                'used_at' => now(),
            ]);
        } catch (\Exception $e) {
            logger()->error('Failed to record coupon redemption: ' . $e->getMessage());
        }
    }
}
