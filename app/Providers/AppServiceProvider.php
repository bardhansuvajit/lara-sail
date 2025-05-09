<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Models\Country;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // set a device id in cookie
        if (!isset($_COOKIE['device_id'])) {
            setcookie('device_id', Str::uuid());
        }

        // set currency in cookie
        if (!isset($_COOKIE['currency'])) {
            setcookie('currency', json_encode([
                "country" => "IN",
                "currency" => "INR"
            ]));
        }

        $countries = collect();

        if (Schema::hasTable('countries')) {
            $countries = Cache::rememberForever('active_countries', function () {
                return Country::active()->get();
            });
        }

        View::share('activeCountries', $countries);
    }
}
