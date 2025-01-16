<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\ProductCategoryInterface;
use App\Interfaces\PasswordInterface;
use App\Interfaces\ProfileInterface;
use App\Interfaces\DeveloperSettingInterface;
use App\Interfaces\ApplicationSettingInterface;

use App\Repositories\ProductCategoryRepository;
use App\Repositories\PasswordRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\DeveloperSettingRepository;
use App\Repositories\ApplicationSettingRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProductCategoryInterface::class, ProductCategoryRepository::class);
        $this->app->bind(PasswordInterface::class, PasswordRepository::class);
        $this->app->bind(ProfileInterface::class, ProfileRepository::class);
        $this->app->bind(DeveloperSettingInterface::class, DeveloperSettingRepository::class);
        $this->app->bind(ApplicationInterface::class, ApplicationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
