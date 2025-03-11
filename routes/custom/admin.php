<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Password\PasswordController;
use App\Http\Controllers\Admin\Country\CountryController;
use App\Http\Controllers\Admin\Product\Listing\ProductListingController;
use App\Http\Controllers\Admin\Product\Category\ProductCategoryController;
use App\Http\Controllers\Admin\Product\Collection\ProductCollectionController;
use App\Http\Controllers\Admin\CsvTemplate\CsvTemplateController;
use App\Http\Controllers\Admin\Trash\TrashController;

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

            // password
            Route::prefix('password')->name('password.')->controller(PasswordController::class)->group(function() {
                Route::get('/edit', 'edit')->name('edit');
                Route::post('/update', 'update')->name('update');
            });

            // activity log
            Route::prefix('activity')->name('activity.')->controller(ActivityController::class)->group(function() {
                Route::get('/', 'index')->name('log');
                Route::delete('/delete/{id}', 'delete')->name('delete');
            });
        });

        // user
        Route::prefix('user')->name('user.')->controller(UserController::class)->group(function() {
            Route::get('/', 'index')->name('index');
        });

        // product
        Route::prefix('product')->name('product.')->group(function() {
            // listing
            Route::prefix('listing')->name('listing.')->controller(ProductListingController::class)->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update', 'update')->name('update');
                Route::delete('/delete/{id}', 'delete')->name('delete');
                Route::post('/bulk', 'bulk')->name('bulk');
                Route::post('/import', 'import')->name('import');
                Route::get('/export/{type}', 'export')->name('export');
            });

            // category
            Route::prefix('category')->name('category.')->controller(ProductCategoryController::class)->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update', 'update')->name('update');
                Route::delete('/delete/{id}', 'delete')->name('delete');
                Route::post('/bulk', 'bulk')->name('bulk');
                Route::post('/import', 'import')->name('import');
                Route::get('/export/{type}', 'export')->name('export');
            });

            // collection
            Route::prefix('collection')->name('collection.')->controller(ProductCollectionController::class)->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update', 'update')->name('update');
                Route::delete('/delete/{id}', 'delete')->name('delete');
                Route::post('/bulk', 'bulk')->name('bulk');
                Route::post('/import', 'import')->name('import');
                Route::get('/export/{type}', 'export')->name('export');
            });
        });

        // master
        Route::prefix('master')->name('master.')->group(function() {
            Route::prefix('country')->name('country.')->controller(CountryController::class)->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update', 'update')->name('update');
                Route::delete('/delete/{id}', 'delete')->name('delete');
                Route::post('/bulk', 'bulk')->name('bulk');
                Route::post('/import', 'import')->name('import');
                Route::get('/export/{type}', 'export')->name('export');
            });
        });

        // developer
        Route::prefix('developer')->name('developer.')->group(function() {
            Route::prefix('trash')->name('trash.')->controller(TrashController::class)->group(function() {
                Route::get('/', 'index')->name('index');
                // Route::get('/create', 'create')->name('create');
                // Route::post('/store', 'store')->name('store');
                // Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update', 'update')->name('update');
                Route::get('/restore/{id}', 'restore')->name('restore');
                Route::get('/export/{type}', 'export')->name('export');
            });
        });

        // csv template
        Route::get('/download-sample-csv/{model}', [CsvTemplateController::class, 'download'])->name('csv-template.download');
    });
});