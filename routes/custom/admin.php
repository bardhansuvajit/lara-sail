<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Product\Listing\ProductListingController;
use App\Http\Controllers\Admin\Product\Category\ProductCategoryController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['redirectAdminIfAuthenticated', 'guest:admin'])->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login/check', [LoginController::class, 'loginCheck'])->name('login.check');
    });

    Route::middleware(['redirectAdminIfNotAuthenticated'])->group(function () {
        Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

        // dashboard
        Route::prefix('dashboard')->name('dashboard.')->group(function() {
            Route::get('/', [DashboardController::class, 'index'])->name('index');
        });

        // profile
        Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/edit', 'edit')->name('edit');
            Route::post('/update', 'update')->name('update');
        });

        // user
        Route::prefix('user')->name('user.')->controller(UserController::class)->group(function() {
            Route::get('/', 'index')->name('index');
        });

        // product
        Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function() {
            
            Route::prefix('listing')->name('listing.')->controller(ProductListingController::class)->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
            });

            // category
            Route::prefix('category')->name('category.')->controller(ProductCategoryController::class)->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
            });
        });
    });
});