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
use App\Models\ProductFeature;

use App\Services\OrderNumberService;
use App\Services\UserLoginHistoryService;

use App\Interfaces\UserLoginHistoryInterface;

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

        $this->app->bind(UserLoginHistoryService::class, function ($app) {
            return new UserLoginHistoryService(
                $app->make(UserLoginHistoryInterface::class)
            );
        });

        // $this->app->bind(UserLoginHistoryService::class, function () {
        //     return new UserLoginHistoryService();
        // });
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
                    "postalCodeDigits" => 6,
                    "flagSvg" => '<svg viewBox="0 0 640 480"xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink><path d="M0 0h640v160H0z"fill=#f93 /><path d="M0 160h640v160H0z"fill=#fff /><path d="M0 320h640v160H0z"fill=#128807 /><g transform="matrix(3.2 0 0 3.2 320 240)"><circle r=20 fill=#008 /><circle r=17.5 fill=#fff /><circle r=3.5 fill=#008 /><g id=in-d><g id=in-c><g id=in-b><g id=in-a fill=#008><circle r=.9 transform="rotate(7.5 -8.8 133.5)"/><path d="M0 17.5.6 7 0 2l-.6 5z"/></g><use height=100% transform=rotate(15) width=100% xlink:href=#in-a /></g><use height=100% transform=rotate(30) width=100% xlink:href=#in-b /></g><use height=100% transform=rotate(60) width=100% xlink:href=#in-c /></g><use height=100% transform=rotate(120) width=100% xlink:href=#in-d /><use height=100% transform=rotate(-120) width=100% xlink:href=#in-d /></g></svg>'
                ])),
                time() + (86400 * 365), // expire in 30 days
                "/" // important: ensure it's global to overwrite
            );
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


        // CACHE - Sponsored products in search bar
        // Remember for 7 days
        // $searchBarSponsoredProducts = collect();
        // if (Schema::hasTable('product_features')) {
        //     $searchBarSponsoredProducts = Cache::remember('search_sponsored_products', now()->addDays(7), function () {
        //         return ProductFeature::where('type', 'search')
        //             ->where('status', 1)
        //             ->orderBy('position')
        //             ->get();
        //     });
        // }

        // dd($searchBarSponsoredProducts);


        // Forget Cache for Testing - REMOVE CODE LATER
        if (Schema::hasTable('cache')) {
            $keys = [
                'active_countries',
                'homepage_products',
                'most_sold_products',
                'homepage_ads',
                'search_sponsored_products',
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
        // View::share('searchBarSponsoredProducts', $searchBarSponsoredProducts);
    }
}
