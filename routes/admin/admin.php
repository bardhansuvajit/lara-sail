<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Order\OfflineOrderController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Password\PasswordController;
use App\Http\Controllers\Admin\Country\CountryController;
use App\Http\Controllers\Admin\Banner\BannerController;
use App\Http\Controllers\Admin\State\StateController;
use App\Http\Controllers\Admin\City\CityController;
use App\Http\Controllers\Admin\Application\ApplicationSettingsController;
use App\Http\Controllers\Admin\NewsletterEmail\NewsletterEmailController;
use App\Http\Controllers\Admin\ContentPage\ContentPageController;
use App\Http\Controllers\Admin\SocialMedia\SocialMediaController;
// use App\Http\Controllers\Admin\Advertisement\AdSectionController;
use App\Http\Controllers\Admin\Advertisement\AdItemController;
use App\Http\Controllers\Admin\Advertisement\AdvertisementController;
use App\Http\Controllers\Admin\Role\RoleController;

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
use App\Http\Controllers\Admin\Product\Coupon\ProductCouponController;
use App\Http\Controllers\Admin\Product\File\ProductFileController;

use App\Http\Controllers\Admin\CsvTemplate\CsvTemplateController;
use App\Http\Controllers\Admin\Trash\TrashController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['redirectAdminIfAuthenticated', 'guest:admin'])->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login/check', [LoginController::class, 'loginCheck'])->name('login.check');
    });

    Route::middleware(['redirectAdminIfNotAuthenticated'])->group(function () {
        Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

        // DASHBOARD - All authenticated admins should have dashboard access
        Route::prefix('dashboard')->name('dashboard.')->middleware(['permission:view_dashboard'])->group(function() {
            Route::get('/', [DashboardController::class, 'index'])->name('index');
        });

        // PROFILE - All authenticated admins can manage their own profile
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

        // APPLICATION SETTINGS - Only specific admins
        Route::prefix('application')->name('application.')->middleware(['permission:manage_settings'])->group(function() {
            Route::prefix('settings')->name('settings.')->controller(ApplicationSettingsController::class)->group(function() {
                Route::get('/{model}', 'index')->name('index');
                Route::get('/{model}/edit', 'edit')->name('edit');
                Route::post('/{model}/update', 'update')->name('update');
            });
        });

        // USERS MANAGEMENT
        Route::prefix('user')->name('user.')->middleware(['permission:manage_users'])->controller(UserController::class)->group(function() {
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

        // ORDERS MANAGEMENT
        Route::prefix('order')->name('order.')->middleware(['permission:manage_orders'])->controller(OrderController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update', 'update')->name('update');
            Route::post('/update/status', 'updateStatus')->name('update.status');
            Route::delete('/delete/{id}', 'delete')->name('delete');
            Route::post('/bulk', 'bulk')->name('bulk');
            Route::post('/import', 'import')->name('import');
            Route::get('/export/{type}', 'export')->name('export');

            // offline order
            Route::prefix('offline')->name('offline.')->controller(OfflineOrderController::class)->group(function() {
                Route::get('/create', 'create')->name('create');
                Route::get('/', 'searchUser')->name('search.user');
            });
        });

        // PRODUCTS MANAGEMENT - Main product permission group
        Route::prefix('product')->name('product.')->middleware(['permission:manage_products'])->group(function() {
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
            Route::prefix('category')->name('category.')->middleware(['permission:manage_categories'])->controller(ProductCategoryController::class)->group(function() {
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
            Route::prefix('collection')->name('collection.')->middleware(['permission:manage_collections'])->controller(ProductCollectionController::class)->group(function() {
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

            // image - Part of product management
            Route::prefix('image')->name('image.')->controller(ProductImageController::class)->group(function() {
                Route::delete('/delete/{id}', 'delete')->name('delete');
            });

            // pricing - Part of product management
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
            Route::prefix('feature')->name('feature.')->middleware(['permission:manage_features'])->controller(ProductFeatureController::class)->group(function() {
                Route::get('/', 'index')->name('index');
                Route::delete('/delete/{id}', 'delete')->name('delete');
            });

            // review
            Route::prefix('review')->name('review.')->middleware(['permission:manage_reviews'])->controller(ProductReviewController::class)->group(function() {
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
            Route::prefix('variation')->name('variation.')->middleware(['permission:manage_variations'])->group(function() {
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

            // coupon
            Route::prefix('coupon')->name('coupon.')->middleware(['permission:manage_coupons'])->controller(ProductCouponController::class)->group(function() {
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

            // file
            Route::prefix('file')->name('file.')->middleware(['permission:manage_files'])->controller(ProductFileController::class)->group(function() {
                Route::get('/delete/{id}', 'delete')->name('delete');
            });
        });

        // MASTER DATA MANAGEMENT
        Route::prefix('master')->name('master.')->middleware(['permission:manage_master'])->group(function() {
            // country
            Route::prefix('country')->name('country.')->middleware(['permission:manage_countries'])->controller(CountryController::class)->group(function() {
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
            Route::prefix('state')->name('state.')->middleware(['permission:manage_states'])->controller(StateController::class)->group(function() {
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
            Route::prefix('city')->name('city.')->middleware(['permission:manage_cities'])->controller(CityController::class)->group(function() {
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

        // WEBSITE MANAGEMENT
        Route::prefix('website')->name('website.')->middleware(['permission:manage_website'])->group(function() {
            // banner
            Route::prefix('banner')->name('banner.')->middleware(['permission:manage_banners'])->controller(BannerController::class)->group(function() {
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

            // advertisement
            Route::prefix('advertisement')->name('advertisement.')->middleware(['permission:manage_advertisements'])->controller(AdvertisementController::class)->group(function() {
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

            // ad - OLD, Remove later, if not needed
            Route::prefix('ad')->name('ad.')->group(function() {
                // section
                Route::prefix('section')->name('section.')->controller(AdSectionController::class)->group(function() {
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

                // item
                Route::prefix('item')->name('item.')->controller(AdItemController::class)->group(function() {
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

            // newsletter email
            Route::prefix('newsletter/email')->name('newsletter.email.')->middleware(['permission:manage_newsletters'])->controller(NewsletterEmailController::class)->group(function() {
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

            // content page
            Route::prefix('content/page')->name('content.page.')->middleware(['permission:manage_content_pages'])->controller(ContentPageController::class)->group(function() {
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

            // social media
            Route::prefix('social-media')->name('social.media.')->middleware(['permission:manage_social_media'])->controller(SocialMediaController::class)->group(function() {
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

        // DEVELOPER OPTIONS
        Route::prefix('developer')->name('developer.')->middleware(['permission:access_developer'])->group(function() {
            Route::prefix('trash')->name('trash.')->middleware(['permission:manage_trash'])->controller(TrashController::class)->group(function() {
                Route::get('/', 'index')->name('index');
                // Route::get('/create', 'create')->name('create');
                // Route::post('/store', 'store')->name('store');
                // Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update', 'update')->name('update');
                Route::get('/restore/{id}', 'restore')->name('restore');
                Route::get('/export/{type}', 'export')->name('export');
            });
        });

        // CSV TEMPLATE - Available to anyone with product/user management permissions
        Route::get('/download-sample-csv/{model}', [CsvTemplateController::class, 'download'])->name('csv-template.download');

        // Include
        if (applicationSettings('company_domain') == 'ed-tech') {
            require __DIR__.'/ed-tech.php';
        }
    });

    Route::get('/unauthorized', function () {
        return view('admin.errors.403');
    })->name('unauthorized');

    Route::get('/not-found', function () {
        return view('admin.errors.404');
    })->name('not-found');
});

Route::fallback(function () {
    if (request()->is('admin/*')) {
        return response()->view('admin.errors.404', [], 404);
    }
});