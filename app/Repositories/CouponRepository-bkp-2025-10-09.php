<?php

namespace App\Repositories;

use App\Interfaces\CouponInterface;
use App\Models\Coupon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\CartInterface;
use App\Interfaces\TrashInterface;
use App\Interfaces\CountryInterface;
use App\Interfaces\ProductImageInterface;
use App\Interfaces\ProductPricingInterface;
use App\Interfaces\ProductBadgeCombinationInterface;
use App\Interfaces\CouponUsageInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

use App\Exports\ProductListingsExport;
use Maatwebsite\Excel\Facades\Excel;

class CouponRepository implements CouponInterface
{
    private CartInterface $cartRepository;
    private TrashInterface $trashRepository;
    private CouponUsageInterface $couponUsageRepository;
    // private CountryInterface $countryRepository;
    // private ProductImageInterface $productImageRepository;
    // private ProductPricingInterface $productPricingRepository;
    // private ProductBadgeCombinationInterface $productBadgeCombinationRepository;

    public function __construct(
        CartInterface $cartRepository,
        TrashInterface $trashRepository, 
        CouponUsageInterface $couponUsageRepository
        // CountryInterface $countryRepository,
        // ProductImageInterface $productImageRepository, 
        // ProductPricingInterface $productPricingRepository, 
        // ProductBadgeCombinationInterface $productBadgeCombinationRepository
    )
    {
        $this->cartRepository = $cartRepository;
        $this->trashRepository = $trashRepository;
        $this->couponUsageRepository = $couponUsageRepository;
        // $this->countryRepository = $countryRepository;
        // $this->productImageRepository = $productImageRepository;
        // $this->productPricingRepository = $productPricingRepository;
        // $this->productBadgeCombinationRepository = $productBadgeCombinationRepository;
    }

    public function list(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = Coupon::query();

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

    public function checkAndApplyToCart(string $couponCode, ?int $userId, string $deviceId)
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

            // Check if cart exists & there are items in cart
            if (!is_null($userId)) {
                $cart = $this->cartRepository->exists(['user_id' => $userId]);
            } else {
                $cart = $this->cartRepository->exists(['device_id' => $deviceId]);
            }

            // Check if cart exists and has items
            if ($cart['code'] != 200 || empty($cart['data']->items)) {
                return [
                    'success' => false,
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'Your cart is empty! Please add some items to cart first.',
                ];
            }

            $cartData = $cart['data'];

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

    /*
    public function store(Array $array)
    {
        // dd($array);

        DB::beginTransaction();

        try {
            // product listing
            $data = new Coupon();
            $data->type = $array['type'];
            $data->title = $array['title'];
            $data->slug = Str::slug($array['title']);
            $data->short_description = $array['short_description'];
            $data->long_description = $array['long_description'];
            $data->category_id = $array['category_id'];
            $data->collection_ids = $array['collection_ids'];

            $data->sku = $array['sku'];
            $data->track_quantity = $array['track_quantity'];
            $data->stock_quantity = $array['stock_quantity'];
            $data->allow_backorders = $array['allow_backorders'];
            $data->meta_title = $array['meta_title'];
            $data->meta_desc = $array['meta_description'];
            $data->status = DEFAULT_PROD_STAT_ID;
            $data->save();

            // PRICING
            if (count($array['pricing']) > 0) {
                foreach ($array['pricing'] as $key => $pricing) {
                    $pricingData = [
                        'product_id' => $data->id,
                        'country_code' => $pricing['country_code'],
                        'selling_price' => $pricing['selling_price'],
                        'mrp' => $pricing['mrp'],
                        'discount' => $pricing['discount_percentage'],
                        'cost' => $pricing['cost'],
                        'profit' => $pricing['profit'],
                        'margin' => $pricing['margin_percentage'],
                    ];
                    $pricingResp = $this->productPricingRepository->store($pricingData);
                }
            }

            // IMAGES
            if (!empty($array['images']) && count($array['images']) > 0) {
                foreach($array['images'] as $imageKey => $singleImage) {
                    $uploadResp = fileUpload($singleImage, 'p-img');

                    $imageData = [
                        'product_id' => $data->id,
                        'image_s' => $uploadResp['smallThumbName'],
                        'image_m' => $uploadResp['mediumThumbName'],
                        'image_l' => $uploadResp['largeThumbName'],
                    ];
                    $imageResp = $this->productImageRepository->store($imageData);
                }
            }

            // BADGES
            if (!empty($array['badges']) && count($array['badges']) > 0) {
                foreach($array['badges'] as $badgeKey => $badgeId) {
                    $badgeCombinationData = [
                        'product_id' => $data->id,
                        'product_badge_id' => $badgeId,
                    ];
                    $badgeCombinationResp = $this->productBadgeCombinationRepository->store($badgeCombinationData);
                }
            }

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

    public function getById(Int $id)
    {
        try {
            // $data = Coupon::find($id);

            $data = Coupon::where('id', $id)
                ->with(['pricings', 'statusDetail', 'activeImages', 'variations' => function($query) {
                    $query->with('product.pricings');
                }])
                ->first();

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

    public function getByIds(Array $ids)
    {
        try {
            if (empty($ids)) {
                return [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'No IDs provided',
                    'data' => [],
                ];
            }

            $data = Coupon::whereIn('id', $ids)->get();

            if ($data->isNotEmpty()) {
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
            $data = Coupon::where('slug', $slug)->first();

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

    public function getBySlugFDCustomArr(String $slug)
    {
        try {
            $data = Coupon::select(['id', 'title', 'slug', 'category_id', 'short_description', 'long_description', 'average_rating', 'review_count', 'status'])
            ->with(['statusDetail', 'category', 'activeImages', 'FDPricing', 'activeVariations', 'reviews', 'badges', 'activeHighlights', 'activeFaqs', 'activeReviews'])
            ->where('slug', $slug)
            ->first();
            // ->toArray();

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
        // dd($array);

        DB::beginTransaction();

        try {
            $data = $this->getById($array['id']);

            if ($data['code'] == 200) {
                if (!empty($array['type']))                 $data['data']->type = $array['type'];
                if (!empty($array['title']))                $data['data']->title = $array['title'];

                // slug
                if (!empty($array['slug']))                 $data['data']->slug = $array['slug'];
                else                                        $data['data']->slug = Str::slug($array['title']);

                if (!empty($array['short_description']))    $data['data']->short_description = $array['short_description'];
                if (!empty($array['long_description']))     $data['data']->long_description = $array['long_description'];
                if (!empty($array['category_id']))          $data['data']->category_id = $array['category_id'];
                if (!empty($array['collection_ids']))       $data['data']->collection_ids = $array['collection_ids'];

                if (!empty($array['sku']))                  $data['data']->sku = $array['sku'];
                if (!empty($array['track_quantity']))       $data['data']->track_quantity = $array['track_quantity'];
                if (!empty($array['stock_quantity']))       $data['data']->stock_quantity = $array['stock_quantity'];
                if (!empty($array['allow_backorders']))     $data['data']->allow_backorders = $array['allow_backorders'];
                if (!empty($array['meta_title']))           $data['data']->meta_title = $array['meta_title'];
                if (!empty($array['meta_description']))     $data['data']->meta_desc = $array['meta_description'];
                if (!empty($array['status']))               $data['data']->status = $array['status'];
                $data['data']->save();

                // PRICING
                // Handle removed prices first
                if (!empty($array['removed_price_ids'])) {
                    foreach ($array['removed_price_ids'] as $removedId) {
                        $deleteResp = $this->productPricingRepository->delete($removedId);
                    }
                }

                if (count($array['pricing']) > 0) {
                    // dd($array['pricing']);
                    foreach ($array['pricing'] as $key => $pricing) {

                        // dd($pricing);

                        $pricingData = [
                            'product_id' => $array['id'],
                            'country_code' => $pricing['country_code'],
                            'selling_price' => $pricing['selling_price'],
                            'mrp' => $pricing['mrp'],
                            'discount' => $pricing['discount_percentage'],
                            'cost' => $pricing['cost'],
                            'profit' => $pricing['profit'],
                            'margin' => $pricing['margin_percentage'],
                        ];

                        // dd($pricingData);

                        // Update Existing Pricing
                        if (!empty($pricing['id'])) {
                            $pricingResp = $this->productPricingRepository->update($pricing['id'], $pricingData);
                        }
                        // Add New Pricing
                        else {
                            $pricingResp = $this->productPricingRepository->store($pricingData);
                        }

                        // dd($pricingResp);
                    }
                }

                // IMAGES
                if (!empty($array['images']) && count($array['images']) > 0) {
                    foreach($array['images'] as $imageKey => $singleImage) {
                        $uploadResp = fileUpload($singleImage, 'p-img');

                        $imageData = [
                            'product_id' => $array['id'],
                            'image_s' => $uploadResp['smallThumbName'],
                            'image_m' => $uploadResp['mediumThumbName'],
                            'image_l' => $uploadResp['largeThumbName'],
                        ];
                        $imageResp = $this->productImageRepository->store($imageData);
                    }
                }

                // BADGES
                // dd($array['badges']);
                if (!empty($array['badges']) && count($array['badges']) > 0) {

                    $productId = $array['id'];
                    $productBadgeResp = $this->productBadgeCombinationRepository->syncProductBadges($productId, $array['badges']);
                    // dd($productBadgeResp);

                }

                DB::commit();

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
                    'model' => 'Coupon',
                    'table_name' => 'products',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => $data['data']->image_s,
                    'title' => $data['data']->title,
                    'description' => $data['data']->title.' data deleted from products table',
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
            $data = Coupon::whereIn('id', $array['ids'])->get();
            if ($array['action'] == 'delete') {
                $data->each(function ($item) {
                    // Handling trash
                    $this->trashRepository->store([
                        'model' => 'Coupon',
                        'table_name' => 'products',
                        'deleted_row_id' => $item->id,
                        'thumbnail' => $item->image_s,
                        'title' => $item->title,
                        'description' => $item->title.' data deleted from products table',
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
            'created' => 0,
            'failed' => 0,
            'errors' => [],
        ];

        // small helpers
        $toBool = fn($v) => filter_var($v, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ? 1 : 0;
        $toIntOrNull = fn($v) => ($v === '' || $v === null) ? null : (int)$v;
        $toFloatOrNull = fn($v) => ($v === '' || $v === null) ? null : (float)$v;
        $parseCollections = function($val) {
            // Accept JSON strings like "[1,2]" or comma separated "1,2"
            if ($val === null || $val === '') return null;
            if (is_array($val)) return $val;
            $val = trim($val);
            // try json decode
            $decoded = json_decode($val, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) return $decoded;
            // fallback: remove surrounding [] then explode
            $val = trim($val, "[] \t\n\r\0\x0B");
            if ($val === '') return null;
            return array_values(array_filter(array_map('trim', explode(',', $val)), fn($v) => $v !== ''));
        };

        try {
            $filePath = fileStore($file);
            $rows = readCsvFile(public_path($filePath)); // returns array of assoc rows

            foreach ($rows as $i => $row) {
                $summary['processed']++;

                // sanitize keys using Arr::get to avoid undefined index
                $title = trim(Arr::get($row, 'title', ''));
                if ($title === '') {
                    $summary['failed']++;
                    $summary['errors'][] = ['row' => $i + 1, 'reason' => 'missing title'];
                    continue;
                }

                // per-row try/catch so one bad row doesn't abort the whole import
                try {
                    DB::beginTransaction();

                    // Build product data (only fields you actually have in your Coupon model)
                    $collections = $parseCollections(Arr::get($row, 'collection_ids'));
                    $productData = [
                        'title' => $title,
                        // if CSV contains slug, use it; otherwise slugify title
                        'slug' => Str::slug(Arr::get($row, 'slug', $title)),
                        'category_id' => $toIntOrNull(Arr::get($row, 'category_id')),
                        // store collection_ids as JSON if your DB column expects JSON/text
                        'collection_ids' => $collections ? json_encode($collections) : null,
                        'short_description' => Arr::get($row, 'short_description') ?: null,
                        'long_description' => Arr::get($row, 'long_description') ?: null,
                        'sku' => Arr::get($row, 'sku') ?: null,
                        'barcode' => Arr::get($row, 'barcode') ?: null,
                        'has_variations' => $toBool(Arr::get($row, 'has_variations', 0)),
                        'stock_quantity' => $toIntOrNull(Arr::get($row, 'stock_quantity')),
                        'track_quantity' => $toBool(Arr::get($row, 'track_quantity', 0)),
                        'allow_backorders' => $toBool(Arr::get($row, 'allow_backorders', 0)),
                        'sold_count' => $toIntOrNull(Arr::get($row, 'sold_count', 0)),
                        'in_cart_count' => $toIntOrNull(Arr::get($row, 'in_cart_count', 0)),
                        'weight' => $toFloatOrNull(Arr::get($row, 'weight', 0)),
                        'height' => $toFloatOrNull(Arr::get($row, 'height', 0)),
                        'width' => $toFloatOrNull(Arr::get($row, 'width', 0)),
                        'length' => $toFloatOrNull(Arr::get($row, 'length', 0)),
                        'weight_unit' => Arr::get($row, 'weight_unit') ?: 'g',
                        'dimension_unit' => Arr::get($row, 'dimension_unit') ?: 'cm',
                        'search_tags' => Arr::get($row, 'search_tags') ?: null,
                        'meta_title' => Arr::get($row, 'meta_title') ?: null,
                        'meta_desc' => Arr::get($row, 'meta_desc') ?: null,
                        'type' => Arr::get($row, 'type', 'physical-product') ?: 'physical-product',
                        // use status from CSV if provided; default to 4/DEFAULT_PROD_STAT_ID so it matches your CSV defaults
                        'status' => $toIntOrNull(Arr::get($row, 'status', DEFAULT_PROD_STAT_ID)) ?? DEFAULT_PROD_STAT_ID,
                    ];

                    // OPTIONAL: avoid duplicate SKUs/slugs — if SKU exists, update instead of create
                    $existing = null;
                    if (!empty($productData['sku'])) {
                        $existing = \App\Models\Coupon::where('sku', $productData['sku'])->first();
                    }
                    if (!$existing && !empty($productData['slug'])) {
                        $existing = \App\Models\Coupon::where('slug', $productData['slug'])->first();
                    }

                    if ($existing) {
                        // update minimal fields (or skip)
                        $existing->fill($productData);
                        $existing->save();
                        $product = $existing;
                    } else {
                        // Ensure Coupon model allows mass assignment for these fields (add them to $fillable)
                        $product = \App\Models\Coupon::create($productData);
                    }

                    // PRICING — do it guarded: don't let pricing errors break import
                    $countryCode = Arr::get($row, 'country_code');
                    if ($countryCode) {
                        try {
                            // $countryResp = $this->countryRepository->getById($countryId);
                            // if (isset($countryResp['code']) && $countryResp['code'] == 200) {
                                // $currencyCode = $countryResp['data']->currency_code;
                                // $currencySymbol = $countryResp['data']->currency_symbol;

                                $selling = $toFloatOrNull(Arr::get($row, 'selling_price', 0)) ?? 0;
                                $mrp = $toFloatOrNull(Arr::get($row, 'mrp', 0)) ?? 0;
                                $cost = $toFloatOrNull(Arr::get($row, 'cost', 0)) ?? 0;

                                $pricingData = [
                                    'product_id' => $product->id,
                                    'country_code' => $countryCode,
                                    // 'country_id' => $countryId,
                                    // 'currency_code' => $currencyCode,
                                    // 'currency_symbol' => $currencySymbol,
                                    'selling_price' => $selling,
                                    'mrp' => $mrp,
                                    'discount' => ($selling && $mrp) ? discountPercentageCalc($selling, $mrp) : 0,
                                    'cost' => $cost,
                                    'profit' => ($selling && $cost) ? profitCalc($selling, $cost) : 0,
                                    'margin' => ($selling && $cost) ? marginCalc($selling, $cost) : 0,
                                ];

                                // Protect pricing creation from throwing fatal exception
                                try {
                                    $this->productPricingRepository->store($pricingData);
                                } catch (\Throwable $pe) {
                                    Log::warning("Pricing store failed for product {$product->id} (row ".($i+1)."): ".$pe->getMessage());
                                    // continue without stopping import
                                }
                            // } else {
                            //     Log::warning("Country not found for row ".($i+1)." country_id: {$countryId}");
                            // }
                        } catch (\Throwable $ce) {
                            Log::warning("Country lookup error for row ".($i+1).": ".$ce->getMessage());
                        }
                    }

                    DB::commit();
                    $summary['created']++;
                } catch (\Throwable $e) {
                    DB::rollBack();
                    $summary['failed']++;
                    $summary['errors'][] = ['row' => $i + 1, 'reason' => $e->getMessage()];
                    Log::error("CSV import row ".($i+1)." failed: ".$e->getMessage());
                    // continue to next row
                    continue;
                }
            }

            return [
                'code' => 200,
                'status' => 'success',
                'message' => "{$summary['created']} / {$summary['processed']} rows processed. {$summary['failed']} failed.",
                'data' => $summary,
            ];
        } catch (\Throwable $e) {
            Log::error('CSV Import Error: ' . $e->getMessage());
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'Import failed: ' . $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }

    public function export(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc', String $type)
    {
        try {
            $data = $this->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

            if (count($data['data']) > 0) {
                $fileName = "products_export_" . date('Y-m-d') . '-' . time();

                if ($type == 'excel') {
                    $fileExtension = ".xlsx";
                    return Excel::download(new ProductListingsExport($data['data']), $fileName.$fileExtension);
                }
                elseif ($type == 'csv') {
                    $fileExtension = ".csv";
                    return Excel::download(new ProductListingsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::CSV);
                }
                elseif ($type == 'html') {
                    $fileExtension = ".html";
                    return Excel::download(new ProductListingsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::HTML);
                }
                elseif ($type == 'pdf') {
                    $fileExtension = ".pdf";
                    return Excel::download(new ProductListingsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::TCPDF);
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
    */
}
