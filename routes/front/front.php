<?php

// use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\Ip\IpController;
use App\Http\Controllers\Front\Home\IndexController;
use App\Http\Controllers\Front\Category\CategoryController;
use App\Http\Controllers\Front\Cart\CartController;
use App\Http\Controllers\Front\Checkout\CheckoutController;
use App\Http\Controllers\Front\Profile\LoginController;
use App\Http\Controllers\Front\Product\ProductController;

Route::name('front.')->group(function () {
    // home
    Route::name('home.')->group(function() {
        Route::get('/', [IndexController::class, 'index'])->name('index');
    });

    // category
    Route::name('category.')->group(function() {
        Route::get('/category', [CategoryController::class, 'index'])->name('index');
    });

    // cart
    Route::name('cart.')->group(function() {
        Route::get('/cart', [CartController::class, 'index'])->name('index');
    });

    // checkout
    Route::name('checkout.')->group(function() {
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('index');
    });

    // pages
    Route::name('error.')->group(function() {
        Route::get('/404', [ErrorPageController::class, 'index'])->name('404');
    });

    // product
    Route::name('product.')->group(function() {
        Route::get('{slug}', [ProductController::class, 'detail'])->name('detail');
    });
});