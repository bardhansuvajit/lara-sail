<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Models\Country;
use App\Models\ProductCategory;
use App\Models\ProductCollection;
use App\Models\SocialMedia;
use App\Models\Cart;

use App\Services\OrderNumberService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OrderNumberService::class, function () {
            return new OrderNumberService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // COOKIE - Device ID
        if (!isset($_COOKIE['device_id'])) {
            setcookie('device_id', Str::uuid());
        }


        // COOKIE - Currency & Country
        if (!isset($_COOKIE['currency'])) {
            setcookie('currency', urlencode(json_encode([
                "country" => "IN",
                "countryFullName" => "India",
                "currency" => "INR",
                "icon" => "₹",
                "phoneCode" => "+91",
                "phoneNoDigits" => 10,
                "postalCodeDigits" => 6
            ])));
        }


        // CACHE - Active Countries
        $countries = collect();
        if (Schema::hasTable('countries')) {
            $countries = Cache::rememberForever('active_countries', function () {
                return Country::active()->get();
            });
        }


        // CACHE - Active Categories
        // ProductCategory::clearActiveCategoriesCache();
        $categories = collect();
        if (Schema::hasTable('product_categories')) {
            // Cache::pull('active_categories');

            $categories = Cache::rememberForever('active_categories', function () {
                // return ProductCategory::active()->orderBy('position')->get();
                return ProductCategory::active()->with('activeChildrenByPosition')
                    ->whereNull('parent_id') // Level 1
                    ->orderBy('position')
                    ->get()
                    ->toArray();
            });
        }


        // CACHE - Active Collections
        $collections = collect();
        if (Schema::hasTable('product_collections')) {
            $collections = Cache::rememberForever('active_collections', function () {
                return ProductCollection::active()->orderBy('position')->get();
            });
        }


        // CACHE - Active Social Media Icons
        $socialMedia = collect();
        if (Schema::hasTable('social_media')) {
            $socialMedia = Cache::rememberForever('active_social_media', function () {
                return SocialMedia::active()->orderBy('position')->get();
            });
        }


        // DB - Cart data
        // $cartData = collect();
        // if (Schema::hasTable('carts')) {
        //     if (auth()->guard('web')->check()) {
        //         $cartData = Cart::where('user_id', auth()->guard('web')->user()->id)
        //             ->with('items')
        //             ->first();
        //     } else {
        //         // dd($_COOKIE['device_id']);
        //         if (!empty($_COOKIE['device_id'])) {
        //             $cartData = Cart::where('device_id', $_COOKIE['device_id'])
        //                 ->with('items')
        //                 ->first();

        //             // dd($cartData);
        //         }
        //     }
        // }


        // FOrget Cache for Testing - REMOVE CODE LATER
        if (Schema::hasTable('cache')) {
            $keys = [
                'homepage_products',
                'most_sold_products',
                'homepage_ads',
            ];

            foreach ($keys as $key) {
                // only forget if the key exists
                if (Cache::has($key)) {
                    Cache::forget($key);
                }
            }
        }

        View::share('activeCountries', $countries);
        View::share('activeCategories', $categories);
        View::share('activeCollections', $collections);
        View::share('socialMedia', $socialMedia);
        // View::share('cartData', $cartData);
    }
}
