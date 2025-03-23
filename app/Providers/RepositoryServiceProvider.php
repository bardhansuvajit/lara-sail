<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\ProductCategoryInterface;
use App\Interfaces\ProductCollectionInterface;
use App\Interfaces\PasswordInterface;
use App\Interfaces\ProfileInterface;
use App\Interfaces\DeveloperSettingInterface;
use App\Interfaces\ApplicationSettingInterface;
use App\Interfaces\CountryInterface;
use App\Interfaces\TrashInterface;
use App\Interfaces\ProductListingInterface;
use App\Interfaces\ProductPricingInterface;
use App\Interfaces\ProductImageInterface;

use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductCollectionRepository;
use App\Repositories\PasswordRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\DeveloperSettingRepository;
use App\Repositories\ApplicationSettingRepository;
use App\Repositories\CountryRepository;
use App\Repositories\TrashRepository;
use App\Repositories\ProductListingRepository;
use App\Repositories\ProductPricingRepository;
use App\Repositories\ProductImageRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProductCategoryInterface::class, ProductCategoryRepository::class);
        $this->app->bind(ProductCollectionInterface::class, ProductCollectionRepository::class);
        $this->app->bind(PasswordInterface::class, PasswordRepository::class);
        $this->app->bind(ProfileInterface::class, ProfileRepository::class);
        $this->app->bind(DeveloperSettingInterface::class, DeveloperSettingRepository::class);
        $this->app->bind(ApplicationInterface::class, ApplicationRepository::class);
        $this->app->bind(CountryInterface::class, CountryRepository::class);
        $this->app->bind(TrashInterface::class, TrashRepository::class);
        $this->app->bind(ProductListingInterface::class, ProductListingRepository::class);
        $this->app->bind(ProductPricingInterface::class, ProductPricingRepository::class);
        $this->app->bind(ProductImageInterface::class, ProductImageRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
