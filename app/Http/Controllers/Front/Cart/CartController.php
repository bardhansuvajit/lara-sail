<?php

namespace App\Http\Controllers\Front\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index(): View
    {
        return view('front.cart.index');
    }

    public function store(Request $request)
    {
        dd($request->all());

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            
        }

    }
}
