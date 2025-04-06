<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Ip\IpController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// ip
Route::prefix('ip')->group(function() {
    Route::get('/check/{ip}', [IpController::class, 'check']);
    Route::post('/store', [IpController::class, 'store']);
});