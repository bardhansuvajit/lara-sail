<?php

namespace App\Http\Controllers\Front\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        return view('front.cart.index');
    }
}
