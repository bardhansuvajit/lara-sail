<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Models\Country;

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


        // DB - Cart data
        $cartData = collect();
        if (Schema::hasTable('carts')) {
            if (auth()->guard('web')->check()) {
                $cartData = \App\Models\Cart::where('user_id', auth()->guard('web')->id())
                    ->with('items')
                    ->first();
            } else {
                if (!empty($_COOKIE['device_id'])) {
                    $cartData = \App\Models\Cart::where('device_id', $_COOKIE['device_id'])
                        ->with('items')
                        ->first();
                }
            }
        }

        View::share('activeCountries', $countries);
        View::share('cartData', $cartData);
    }
}
