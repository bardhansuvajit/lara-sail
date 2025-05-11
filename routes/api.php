<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Ip\IpController;
use App\Http\Controllers\Api\Cart\CartController;
use App\Http\Controllers\Api\Product\Variation\ProductVariationController;
use App\Http\Controllers\Api\Product\Variation\ProductVariationCombinationController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// ip
Route::prefix('ip')->group(function() {
    Route::get('/check/{ip}', [IpController::class, 'check']);
    Route::post('/store', [IpController::class, 'store']);
});

// cart
Route::prefix('cart')->group(function() {
    Route::get('/device-id/{deviceId}', [CartController::class, 'indexDeviceId']);
    Route::get('/user-id/{userId}', [CartController::class, 'indexUserId']);
});

// variation
Route::prefix('variation')->group(function() {
    // listing
    Route::controller(ProductVariationController::class)->group(function() {
        Route::post('/store', 'store');
    });

    // combination
    Route::controller(ProductVariationCombinationController::class)->group(function() {
        Route::post('/check', 'check');
    });
});