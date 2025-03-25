<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\Home\IndexController;
use App\Http\Controllers\Front\Category\CategoryController;
use App\Http\Controllers\Front\Cart\CartController;
use App\Http\Controllers\Front\Profile\LoginController;


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

    // profile
    Route::name('login.')->group(function() {
        Route::get('/login', [LoginController::class, 'index'])->name('index');
    });
});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
require __DIR__.'/custom/admin.php';
