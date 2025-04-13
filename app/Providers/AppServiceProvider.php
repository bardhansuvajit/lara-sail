<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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
        $countries = collect();

        if (Schema::hasTable('countries')) {
            $countries = Cache::rememberForever('active_countries', function () {
                return Country::active()->get();
            });
        }

        View::share('activeCountries', $countries);
    }
}
