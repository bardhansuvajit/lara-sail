<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Password\PasswordController;
use App\Http\Controllers\Admin\Country\CountryController;
use App\Http\Controllers\Admin\State\StateController;
use App\Http\Controllers\Admin\City\CityController;
use App\Http\Controllers\Admin\Application\ApplicationSettingsController;

use App\Http\Controllers\Admin\Product\Listing\ProductListingController;
use App\Http\Controllers\Admin\Product\Category\ProductCategoryController;
use App\Http\Controllers\Admin\Product\Category\Variation\ProductCategoryVariationAttributeController;
use App\Http\Controllers\Admin\Product\Collection\ProductCollectionController;
use App\Http\Controllers\Admin\Product\Image\ProductImageController;
use App\Http\Controllers\Admin\Product\Pricing\ProductPricingController;
use App\Http\Controllers\Admin\Product\Feature\ProductFeatureController;
use App\Http\Controllers\Admin\Product\Review\ProductReviewController;
use App\Http\Controllers\Admin\Product\Variation\ProductVariationAttributeController;
use App\Http\Controllers\Admin\Product\Variation\ProductVariationAttributeValueController;
use App\Http\Controllers\Admin\Product\Variation\ProductVariationController;

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

        // application
        Route::prefix('application')->name('application.')->group(function() {
            Route::prefix('settings')->name('settings.')->controller(ApplicationSettingsController::class)->group(function() {
                Route::get('/{model}', 'index')->name('index');
                Route::get('/{model}/edit', 'edit')->name('edit');
                Route::post('/{model}/update', 'update')->name('update');
            });
        });

        // user
        Route::prefix('user')->name('user.')->controller(UserController::class)->group(function() {
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

        // order
        Route::prefix('order')->name('order.')->controller(OrderController::class)->group(function() {
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
                Route::get('/bulk/edit', 'bulkEdit')->name('bulk.edit');
                Route::post('/bulk/update', 'bulkUpdate')->name('bulk.update');
                Route::post('/import', 'import')->name('import');
                Route::get('/export/{type}', 'export')->name('export');

                Route::prefix('variation')->name('variation.')->controller(ProductVariationController::class)->group(function() {
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::post('/update', 'update')->name('update');
                    Route::delete('/delete/{id}', 'delete')->name('delete');
                });
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

                // variation
                Route::prefix('variation')->name('variation.')->controller(ProductCategoryVariationAttributeController::class)->group(function() {
                    Route::get('/toggle/{categoryId}/{attrValueId}', 'toggle')->name('toggle');
                    Route::delete('/delete/{id}', 'delete')->name('delete');
                });
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
                Route::post('/position', 'position')->name('position');
            });

            // image
            Route::prefix('image')->name('image.')->controller(ProductImageController::class)->group(function() {
                Route::delete('/delete/{id}', 'delete')->name('delete');
            });

            // pricing
            Route::prefix('pricing')->name('pricing.')->controller(ProductPricingController::class)->group(function() {
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

            // feature
            Route::prefix('feature')->name('feature.')->controller(ProductFeatureController::class)->group(function() {
                Route::get('/', 'index')->name('index');
                Route::delete('/delete/{id}', 'delete')->name('delete');
            });

            // review
            Route::prefix('review')->name('review.')->controller(ProductReviewController::class)->group(function() {
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

            // variation
            Route::prefix('variation')->name('variation.')->group(function() {
                // attribute
                Route::prefix('attribute')->name('attribute.')->controller(ProductVariationAttributeController::class)->group(function() {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::post('/update', 'update')->name('update');
                    Route::delete('/delete/{id}', 'delete')->name('delete');
                    Route::post('/bulk', 'bulk')->name('bulk');
                    Route::post('/import', 'import')->name('import');
                    Route::get('/export/{type}', 'export')->name('export');
                    Route::post('/position', 'position')->name('position');
                });

                // attribute value
                Route::prefix('attribute/value')->name('attribute.value.')->controller(ProductVariationAttributeValueController::class)->group(function() {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::post('/update', 'update')->name('update');
                    Route::delete('/delete/{id}', 'delete')->name('delete');
                    Route::post('/bulk', 'bulk')->name('bulk');
                    Route::post('/import', 'import')->name('import');
                    Route::get('/export/{type}', 'export')->name('export');
                    Route::post('/position', 'position')->name('position');
                });
            });
        });

        // master
        Route::prefix('master')->name('master.')->group(function() {
            // country
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

            // state
            Route::prefix('state')->name('state.')->controller(StateController::class)->group(function() {
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

            // city
            Route::prefix('city')->name('city.')->controller(CityController::class)->group(function() {
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