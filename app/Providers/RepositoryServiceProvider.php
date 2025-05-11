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
use App\Interfaces\ProductFeatureInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\IpInterface;
use App\Interfaces\ProductReviewInterface;
use App\Interfaces\ProductReviewImageInterface;
use App\Interfaces\ProductVariationAttributeInterface;
use App\Interfaces\ProductVariationAttributeValueInterface;
use App\Interfaces\ProductCategoryVariationAttributeInterface;
use App\Interfaces\ProductVariationInterface;
use App\Interfaces\ProductVariationCombinationInterface;
use App\Interfaces\StateInterface;
use App\Interfaces\CityInterface;
use App\Interfaces\CartInterface;
use App\Interfaces\CartItemInterface;

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
use App\Repositories\ProductFeatureRepository;
use App\Repositories\UserRepository;
use App\Repositories\IpRepository;
use App\Repositories\ProductReviewRepository;
use App\Repositories\ProductReviewImageRepository;
use App\Repositories\ProductVariationAttributeRepository;
use App\Repositories\ProductVariationAttributeValueRepository;
use App\Repositories\ProductCategoryVariationAttributeRepository;
use App\Repositories\ProductVariationRepository;
use App\Repositories\ProductVariationCombinationRepository;
use App\Repositories\StateRepository;
use App\Repositories\CityRepository;
use App\Repositories\CartRepository;
use App\Repositories\CartItemRepository;

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
        $this->app->bind(ProductFeatureInterface::class, ProductFeatureRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(IpInterface::class, IpRepository::class);
        $this->app->bind(ProductReviewInterface::class, ProductReviewRepository::class);
        $this->app->bind(ProductReviewImageInterface::class, ProductReviewImageRepository::class);
        $this->app->bind(ProductVariationAttributeInterface::class, ProductVariationAttributeRepository::class);
        $this->app->bind(ProductVariationAttributeValueInterface::class, ProductVariationAttributeValueRepository::class);
        $this->app->bind(ProductCategoryVariationAttributeInterface::class, ProductCategoryVariationAttributeRepository::class);
        $this->app->bind(ProductVariationInterface::class, ProductVariationRepository::class);
        $this->app->bind(ProductVariationCombinationInterface::class, ProductVariationCombinationRepository::class);
        $this->app->bind(StateInterface::class, StateRepository::class);
        $this->app->bind(CityInterface::class, CityRepository::class);
        $this->app->bind(CartInterface::class, CartRepository::class);
        $this->app->bind(CartItemInterface::class, CartItemRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
