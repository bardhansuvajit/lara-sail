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

    public function list(?String $keyword = '', array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
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
            // $this->incrementCouponUsage($coupon->id);

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

    public function couponDiscountApplicableToCart($cartData)
    {
        try {
            $cartId = $cartData->id;
            $userId = $cartData->user_id;
            $couponCode = $cartData->coupon_code;

            $coupon = Coupon::where('code', strtolower(trim($couponCode)))
                ->where('status', 1)
                ->where('show_in_frontend', true)
                ->where('starts_at', '<=', now())
                ->where('expires_at', '>=', now())
                ->first();

            // dd($coupon);

            if (!$coupon) {
                // Invalid or expired coupon code
                $couponRemoveResp = $this->cartRepository->removeCouponById($cartId);
            }

            // Check usage limits
            if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
                // Coupon has reached its usage limit
                $couponRemoveResp = $this->cartRepository->removeCouponById($cartId);
            }

            // Check per user usage limit
            if ($coupon->usage_per_user) {
                if (!is_null($userId)) {
                    $couponUsageData = $this->couponUsageRepository->getUserCouponUsageCount($coupon->id, $userId);
                    if ($couponUsageData['count'] >= $coupon->usage_per_user) {
                        // User already used this coupon the maximum number of times
                        $couponRemoveResp = $this->cartRepository->removeCouponById($cartId);
                    }
                }
            }

            // Check minimum cart value
            // dd($cartData, $coupon);
            // this cartTotal is after coupon discount, which might be less than $coupon->min_cart_value
            $cartTotal = $cartData->total ?? 0;
            $cartTotal += $cart->coupon_discount_amount;
            // dd($cartTotal, $coupon->min_cart_value);
            if ($coupon->min_cart_value && $cartTotal < $coupon->min_cart_value) {
                $symbol = $cartData->countryDetail->currency_symbol;
                // Minimum cart value doesnt match
                $couponRemoveResp = $this->cartRepository->removeCouponById($cartId);
                // 'message' => "Minimum cart value required: {$symbol}" . formatIndianMoney($coupon->min_cart_value),
            }

            // dd('jj');

            // Calculate discount
            $discountAmount = $this->calculateDiscount($coupon, $cartTotal);

            if ($discountAmount != $cartData->coupon_discount_amount) {
                // Calculated discount & Cart discount doesnt match
                $couponRemoveResp = $this->cartRepository->removeCouponById($cartId);
            }

            return [
                'success' => true,
                'code' => 200,
                'status' => 'success',
                'message' => 'Applied coupon is OK!',
            ];

            /*
            // dd($discountAmount);

            // Apply coupon to cart (update cart with discount)
            $applied = $this->applyCouponToCart($cartData->id, $coupon, $discountAmount);

            // dd($applied);

            if (!$applied) {
                // Failed to apply coupon to cart
                $couponRemoveResp = $this->cartRepository->removeCouponById($cartId);
                // return [
                //     'success' => false,
                //     'code' => 500,
                //     'status' => 'error',
                //     'message' => 'Failed to apply coupon to cart',
                // ];
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
            */
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
                    'country_code' => $coupon->country_code,
                    'code' => $coupon->code,
                    'name' => $coupon->name,
                    'description' => $coupon->description,
                    'discount_type' => $coupon->discount_type,
                    'value' => $coupon->value,
                    'max_discount_amount' => $coupon->max_discount_amount,
                    'min_cart_value' => $coupon->min_cart_value,
                    'applied_at' => now()->toISOString(),
                    'starts_at' => $coupon->starts_at,
                    'expires_at' => $coupon->expires_at,
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

    public function incrementCouponUsage(int $couponId): void
    {
        Coupon::where('id', $couponId)->increment('used_count');
    }

    public function store(array $array)
    {
        // dd($array['image']);
        try {
            $data = new Coupon();
            $data->country_code = $array['country_code'];
            $data->code = $array['code'];
            $data->name = $array['name'];
            $data->description = $array['description'] ?? null;
            $data->discount_type = $array['discount_type'];
            $data->value = $array['value'];
            $data->max_discount_amount = $array['max_discount_amount'];
            $data->min_cart_value = $array['min_cart_value'];
            $data->usage_limit = $array['usage_limit'];
            $data->usage_per_user = $array['usage_per_user'];
            $data->used_count = $array['used_count'] ?? 0;
            $data->starts_at = $array['starts_at'];
            $data->expires_at = $array['expires_at'];
            $data->show_in_frontend = $array['show_in_frontend'] ?? 0;

            // get max position for given attribute_id and type
            $lastPosition = Coupon::where('country_code', $array['country_code'])->max('position');
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

    public function getById(int $id)
    {
        try {
            $data = Coupon::find($id);

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
            $data = Coupon::with('activeProductsInChildren', 'ancestors', 'activeProducts')->where('slug', $slug)->first();

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

    public function update(array $array)
    {
        try {
            $data = $this->getById($array['id']);

            if ($data['code'] == 200) {
                // if (!empty($array['title'])) {
                //     $data['data']->title = $array['title'];
                //     $data['data']->slug = \Str::slug($array['title']);
                // }

                // $data['data']->level = $array['level'];
                // $data['data']->parent_id = $array['parent_id'] ?? null;

                // $data['data']->short_description = $array['short_description'] ?? null;
                // $data['data']->long_description = $array['long_description'] ?? null;

                // $data['data']->save();

                $data = $data['data'];

                $data->country_code = $array['country_code'];
                $data->code = $array['code'];
                $data->name = $array['name'];
                $data->description = $array['description'];
                $data->discount_type = $array['discount_type'];
                $data->value = $array['value'];
                $data->max_discount_amount = $array['max_discount_amount'];
                $data->min_cart_value = $array['min_cart_value'];
                $data->usage_limit = $array['usage_limit'];
                $data->usage_per_user = $array['usage_per_user'];
                $data->starts_at = $array['starts_at'];
                $data->expires_at = $array['expires_at'];
                $data->show_in_frontend = $array['show_in_frontend'];
                $data->save();

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
                // 'message' => 'An error occurred while updating data.',
                'message' => $e->getMessage(),
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
                $this->trashRepository->store([
                    'model' => 'Coupon',
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

    public function bulkAction(array $array)
    {
        try {
            $data = Coupon::whereIn('id', $array['ids'])->get();
            if ($array['action'] == 'delete') {
                $data->each(function ($item) {
                    // Handling trash
                    $this->trashRepository->store([
                        'model' => 'Coupon',
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
                    $existing = Coupon::where('slug', $slug)->first();

                    if ($existing) {
                        $summary['skipped']++;
                        $summary['skipped_rows'][] = $i + 1;
                        DB::rollBack(); // no changes
                        continue;
                    }

                    // Get next position (could also scope by parent_id if needed)
                    $lastPosition = Coupon::max('position') ?? 0;

                    Coupon::create([
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
            // $processedCount = saveToDatabase($data, 'Coupon');

            // save into Database
            $processedCount = 0;

            foreach ($data as $item) {
                if (!isset($item['title'])) {
                    continue; // Skip rows without a title
                }

                // get max position for given attribute_id and type
                $lastPosition = Coupon::max('position');

                // dd($item['parent_id']);

                Coupon::create([
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

    public function export(?String $keyword = '', array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc', String $type)
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

    public function position(array $ids)
    {
        try {
            foreach ($ids as $index => $id) {
                Coupon::where('id', $id)->update([
                    'position' => $index + 1
                ]);
            }
            Coupon::clearActiveCategoriesCache();

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
