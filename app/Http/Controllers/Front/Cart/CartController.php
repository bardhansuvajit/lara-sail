<?php

namespace App\Http\Controllers\Front\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Cart;

class CartController extends Controller
{
    public function index(): View
    {
        return view('front.cart.index');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variation' => 'nullable|json'
        ]);

        // Get or create cart
        $cart = $this->getOrCreateCart();

        // Find product
        $product = Product::with(['pricings', 'variations' => function($query) {
            $query->with('product.pricings');
        }])->find($request->product_id);

        // Product data
        $sku = $product->sku;

        // Currency
        $currencyData = countryCurrencyData()['currency'];
        $pricingData = $product->pricings;

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

        // dd($pricingData);

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

            // dd($variationsUpdated);

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
                }, '=', count($variationsUpdated)) // Must match all variations
                ->first();

            // dd(DB::getQueryLog());

            // dd($productVariation);

            if ($productVariation) {
                $productVariationId = $productVariation->id;
                $variationData = $this->formatVariationData($productVariation);
                $variationAttributes = implode(', ', array_values($variationsUpdated));

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
                // dd('outside');

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

        if ($existingItem) {
            // Update quantity if item exists
            $existingItem->update([
                'quantity' => $existingItem->quantity + $request->quantity,
                'total' => ($existingItem->quantity + $request->quantity) * $existingItem->selling_price
            ]);
        } else {
            // dd($productVariationId);

            // Create new cart item
            $cart->items()->create([
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
        }

        // Update cart totals
        $this->updateCartTotals($cart);

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Item added to cart.',
            'cart_count' => $cart->total_items,
            'cart_data' => $cart->items
        ]);

    }

    private function formatVariationData($productVariation)
    {
        return $productVariation->combinations->mapWithKeys(function($combination) {
            return [
                $combination->attribute->slug => $combination->attributeValue->slug
            ];
        })->toArray();
    }

    private function getOrCreateCart()
    {
        if (auth()->guard('web')->check()) {
            return Cart::firstOrCreate([
                'user_id' => auth()->id()
            ]);
        }

        $deviceId = $_COOKIE['device_id'] ?? Str::uuid();

        return Cart::firstOrCreate([
            'device_id' => $deviceId,
            'user_id' => null
        ]);
    }

    private function formatVariationAttributes($variations)
    {
        // dd($variations);
        if (empty($variations)) return null;

        return collect($variations)
            ->map(fn($value, $key) => ucfirst(str_replace('-', ' ', $key)).': '.$value)
            ->join(', ');
    }

    private function updateCartTotals($cart)
    {
        $cart->update([
            'total_items' => $cart->items()->sum('quantity'),
            'sub_total' => $cart->items()->sum('total'),
            'total' => $cart->items()->sum('total'), // Base total before any adjustments
            'last_activity_at' => now()
        ]);
    }
}
