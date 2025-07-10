<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Ip\IpController;
use App\Http\Controllers\Api\Cart\CartController;
use App\Http\Controllers\Api\Product\Variation\ProductVariationController;
use App\Http\Controllers\Api\Product\Variation\ProductVariationCombinationController;
use App\Http\Controllers\Api\Login\LoginController;
use App\Http\Controllers\Api\Token\TokenController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/test', function() {
    return response()->json([
        'code' => 200,
        'message' => 'API success',
    ]);
});

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



// Login
Route::prefix('login')->group(function() {
    Route::controller(LoginController::class)->group(function() {
        // phone number check
        Route::post('/check', 'check');
        // login with password
        Route::post('/try', 'login');
        // register
        Route::post('/store', 'store');
    });
});

// Token
Route::prefix('token')->group(function() {
    Route::controller(TokenController::class)->group(function() {
        Route::get('/validate', 'validate');
    });
});