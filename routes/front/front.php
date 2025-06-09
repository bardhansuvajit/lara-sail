<?php

// use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\Ip\IpController;
use App\Http\Controllers\Front\Home\IndexController;
use App\Http\Controllers\Front\Category\CategoryController;
use App\Http\Controllers\Front\Cart\CartController;
use App\Http\Controllers\Front\Checkout\CheckoutController;
use App\Http\Controllers\Front\Profile\LoginController;
use App\Http\Controllers\Front\Product\ProductController;
use App\Http\Controllers\Front\Order\OrderController;
use App\Http\Controllers\Front\Wishlist\WishlistController;

Route::name('front.')->group(function () {
    // home
    Route::name('home.')->group(function() {
        Route::get('/', [IndexController::class, 'index'])->name('index');
    });

    // category
    Route::name('category.')->group(function() {
        Route::get('/category', [CategoryController::class, 'index'])->name('index');
    });

    // collection
    Route::name('collection.')->group(function() {
        Route::get('/collection', [CategoryController::class, 'index'])->name('index');
    });

    // wishlist
    Route::name('wishlist.')->prefix('wishlist')->group(function() {
        Route::post('/check-status', [WishlistController::class, 'checkStatus'])->name('check');
        Route::get('/toggle/{productId}', [WishlistController::class, 'toggle'])->name('toggle');
    });

    // cart
    Route::name('cart.')->prefix('cart')->controller(CartController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::post('/store', 'store')->name('store');
        Route::post('/qty/update', 'qtyUpdate')->name('qty.update');
        Route::post('/update', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });

    // checkout
    Route::name('checkout.')->group(function() {
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('index');
    });

    // order
    Route::name('order.')->prefix('order')->controller(OrderController::class)->group(function() {
        Route::post('/store', 'store')->name('store');
        Route::get('/thankyou', 'thankyou')->name('thankyou');
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