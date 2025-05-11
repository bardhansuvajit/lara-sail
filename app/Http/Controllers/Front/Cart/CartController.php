<?php

namespace App\Http\Controllers\Front\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\CartInterface;
use App\Interfaces\CartItemInterface;
use App\Interfaces\ProductListingInterface;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Cart;

class CartController extends Controller
{
    private CartInterface $cartRepository;
    private CartItemInterface $cartItemRepository;
    private ProductListingInterface $productListingRepository;

    public function __construct(CartInterface $cartRepository, CartItemInterface $cartItemRepository, ProductListingInterface $productListingRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->productListingRepository = $productListingRepository;
    }

    public function index(): View
    {
        return view('front.cart.index');
    }

    public function fetch()
    {
        try {
            // Insert/ Get data from Cart
            if (auth()->guard('web')->check()) {
                $cart = $this->cartRepository->exists([
                    'user_id' => auth()->guard('web')->id()
                ]);
            } else {
                $deviceId = $_COOKIE['device_id'] ?? Str::uuid();

                $cart = $this->cartRepository->exists([
                    'device_id' => $deviceId,
                ]);
            }

            $cart = $cart['data'];

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Cart data found.',
                'cart_info' => $cart,
                'cart_count' => $cart->total_items,
                'cart_items' => $cart->items
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while storing data.',
                // 'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ]);
            // throw $th;
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variation' => 'nullable|json'
        ]);

        DB::beginTransaction();

        try {
            // Insert/ Get data from Cart
            if (auth()->guard('web')->check()) {
                $cart = $this->cartRepository->store([
                    'device_id' => null,
                    'user_id' => auth()->guard('web')->id()
                ]);
            } else {
                $deviceId = $_COOKIE['device_id'] ?? Str::uuid();

                $cart = $this->cartRepository->store([
                    'device_id' => $deviceId,
                    'user_id' => null
                ]);
            }

            $cart = $cart['data'];

            // Product data fetch
            $product = $this->productListingRepository->getById($request->product_id)['data'];
            $sku = $product->sku ? $product->sku : $product->slug;
            $pricingData = $product->pricings;

            // Currency/ Pricing
            $currencyData = countryCurrencyData()['currency'];

            foreach ($pricingData as $pricingKey => $pricingValue) {
                if ($pricingValue->currency_code == $currencyData) {
                    $sellingPrice = $pricingValue->selling_price;
                    $mrp = $pricingValue->mrp;
                } else {
                    return response()->json([
                        'code' => 500,
                        'status' => 'error',
                        'message' => 'No pricing found. Please try again.'
                    ]);
                }
            }

            // Handle variations
            $variationData = [];
            $productVariationId = null;
            $variationAttributes = null;
            $variationSellingPrice = $sellingPrice;

            if ($request->has('variation')) {
                $variations = json_decode($request->variation, true);

                // Filter Attribute & Values slug
                $variationsUpdated = array_combine(
                    array_map(fn($key) => str_replace('variation-', '', $key), array_keys($variations)),
                    $variations
                );

                // $variationsUpdated = [
                //     "color" => "forest-green"
                //     "screen-size" => "136-inch"
                //     "ssd-capacity" => "512gb"
                //     "system-memory" => "24gb"
                // ];

                // Match variation combinations
                $productVariation = ProductVariation::where('product_id', $request->product_id)
                    ->whereHas('combinations', function ($query) use ($variationsUpdated) {
                        $query->where(function ($q) use ($variationsUpdated) {
                            foreach ($variationsUpdated as $attributeSlug => $valueSlug) {
                                $q->orWhere(function ($subQuery) use ($attributeSlug, $valueSlug) {
                                    $subQuery->whereHas('attribute', function ($q) use ($attributeSlug) {
                                        $q->where('slug', $attributeSlug);
                                    })
                                    ->whereHas('attributeValue', function ($q) use ($valueSlug) {
                                        $q->where('slug', $valueSlug);
                                    });
                                });
                            }
                        });
                    }, '=', count($variationsUpdated))
                    ->with(['combinations' => function($query) {
                        $query->with(['attribute', 'attributeValue']);
                    }])
                    ->first();

                // dd($productVariation);

                if ($productVariation) {
                    $productVariationId = $productVariation->id;
                    $variationData = $this->formatVariationData($productVariation);
                    // $variationAttributes = implode(', ', array_values($variationsUpdated));
                    $variationTitles = [];
                    foreach ($productVariation->combinations as $combination) {
                        $variationTitles[] = $combination->attributeValue->title;
                    }
                    $variationAttributes = implode(', ', $variationTitles);

                    // SKU
                    $sku = $productVariation->sku ? $productVariation->sku : $productVariation->variation_identifier;

                    // Selling Price
                    $sellingPriceAdjustment = $productVariation->price_adjustment;
                    $priceAdjustmentType = $productVariation->adjustment_type;
                    // dd($productVariation->price_adjustment);

                    // dd($sellingPriceAdjustment, $priceAdjustmentType);

                    if ($sellingPriceAdjustment > 0) {
                        // dd('inside');
                        if ($priceAdjustmentType == "fixed") {
                            $variationSellingPrice = $sellingPrice + $sellingPriceAdjustment;
                        } else {
                            $variationSellingPrice = $sellingPrice + ($sellingPrice * ($sellingPriceAdjustment / 100));
                        }
                    }
                } else {
                    return response()->json([
                        'code' => 500,
                        'status' => 'error',
                        'message' => 'No variation found. Please try again.'
                    ]);
                }
            }

            // Check if item already exists in cart
            $existingItem = $cart->items()
                ->where('product_id', $product->id)
                ->when($productVariationId, function($query, $productVariationId) {
                    $query->where('product_variation_id', $productVariationId);
                })
                ->first();

            // dd($existingItem);

            if ($existingItem) {
                // Update quantity if item exists
                $this->cartItemRepository->update([
                    'id' => $existingItem->id,
                    'quantity' => $existingItem->quantity + $request->quantity,
                    'total' => ($existingItem->quantity + $request->quantity) * $existingItem->selling_price
                ]);
            } else {
                // Create new cart item
                $cartItemResp = $this->cartItemRepository->store([
                    'cart_id' => $cart->id,
                    'product_id' => $request->product_id,
                    'product_title' => $product->title,
                    'product_variation_id' => $productVariationId,
                    'variation_attributes' => $variationAttributes,
                    'sku' => $sku,
                    'selling_price' => $variationSellingPrice,
                    'mrp' => $productVariationId ? ($variationSellingPrice > $mrp ? 0 : $mrp) : $mrp,
                    'quantity' => $request->quantity,
                    'total' => $request->quantity * ($productVariationId ? $variationSellingPrice : $sellingPrice),
                    'is_available' => 1,
                    'availability_message' => 'In stock',
                    'options' => null,
                    'custom_fields' => null
                ]);

                // dd($cartItemResp);
            }

            // Update cart totals
            $cartResponse = $this->cartRepository->updateCartTotals($cart);

            // dd($cartResponse);
            DB::commit();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Item added to cart.',
                'cart_info' => $cart,
                'cart_count' => $cart->total_items,
                'cart_items' => $cart->items
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while storing data.',
                // 'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ]);
            // throw $th;
        }
    }

    private function formatVariationData($productVariation)
    {
        return $productVariation->combinations->mapWithKeys(function($combination) {
            return [
                $combination->attribute->slug => $combination->attributeValue->slug
            ];
        })->toArray();
    }

    public function qtyUpdate(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id' => 'required|exists:cart_items,id',
            'type' => 'required|in:asc,desc'
        ]);

        try {
            $resp = $this->cartItemRepository->qtyUpdate([
                'id' => $request->id,
                'type' => $request->type
            ]);

            $cart = $resp['cart'];

            // Update cart totals
            $cartResponse = $this->cartRepository->updateCartTotals($cart);

            // dd($cartResponse);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Quantity updated',
                'cart_info' => $cart,
                'cart_count' => $cart->total_items,
                'cart_items' => $cart->items
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while updating data.',
                // 'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ]);
            // throw $th;
        }

    }
}
