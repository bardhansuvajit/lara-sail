<?php

namespace App\Http\Controllers\Front\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

use Illuminate\Support\Facades\Validator;
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

        // Handle variations
        $variationData = [];
        $productVariationId = null;

        if ($request->has('variation')) {
            dd($request->variation);
            $variations = json_decode($request->variation, true);
            
            // Find matching product variation through combinations
            $productVariation = ProductVariation::where('product_id', $product->id)
                ->whereHas('combinations', function($query) use ($variations) {
                    foreach ($variations as $attributeSlug => $valueSlug) {
                        $query->whereHas('attribute', function($q) use ($attributeSlug) {
                            $q->where('slug', $attributeSlug);
                        })->whereHas('attributeValue', function($q) use ($valueSlug) {
                            $q->where('slug', $valueSlug);
                        });
                    }
                }, '=', count($variations)) // Must match all variations
                ->first();
        
            if ($productVariation) {
                $productVariationId = $productVariation->id;
                $variationData = $this->formatVariationData($productVariation);
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
            // Create new cart item
            $cart->items()->create([
                'product_id' => $product->id,
                'product_variation_id' => $productVariationId,
                'product_name' => $product->title,
                'variation_attributes' => $this->formatVariationAttributes($variationData),
                'sku' => $productVariationId ? $productVariation->sku : $product->sku,
                // 'selling_price' => $productVariationId ? $productVariation->price : $product->price,
                // 'mrp' => $productVariationId ? $productVariation->mrp : $product->mrp,
                // 'selling_price' => $productVariationId ? $productVariation->final_price : $product->pricings->selling_price,
                'selling_price' => $productVariationId ? $productVariation->final_price : $product->final_price,
                'mrp' => 0,
                // 'mrp' => $productVariationId ? ($productVariation->product->pricings->mrp ?? 0) : ($product->pricings->mrp ?? 0),
                'quantity' => $request->quantity,
                'total' => $request->quantity * ($productVariationId ? $productVariation->price : $product->price),
                'options' => $variationData ?: null,
            ]);
        }

        // Update cart totals
        $this->updateCartTotals($cart);

        return response()->json([
            'success' => true,
            'cart_count' => $cart->total_items,
            'message' => 'Item added to cart'
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

        // For guests, use device ID
        $deviceId = $_COOKIE['device_id'] ?? Str::uuid();

        return Cart::firstOrCreate([
            'device_id' => $deviceId,
            'user_id' => null
        ]);
    }

    private function formatVariationAttributes($variations)
    {
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
