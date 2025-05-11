<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\View\View;
use App\Interfaces\CartItemInterface;

class CartController extends Controller
{
    private CartItemInterface $cartItemRepository;

    public function __construct(CartItemInterface $cartItemRepository)
    {
        $this->cartItemRepository = $cartItemRepository;
    }

    public function qtyUpdate(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id' => 'required|exists:cart_items,id',
            'type' => 'required|in:asc,desc'
        ]);

        $resp = $this->cartItemRepository->update([
            'id' => $request->id,
            'type' => $request->type
        ]);

        dd($resp);

        // return response()->json([
        //     'code' => 200,
        //     'status' => 'success',
        //     'message' => 'Item added to cart.',
        //     'cart_info' => $cart,
        //     'cart_count' => $cart->total_items,
        //     'cart_items' => $cart->items
        // ]);
    }
}
