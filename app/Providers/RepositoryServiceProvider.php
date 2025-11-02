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
use App\Interfaces\CartSettingInterface;
use App\Interfaces\AddressInterface;
use App\Interfaces\PaymentMethodInterface;
use App\Interfaces\OrderInterface;
use App\Interfaces\OrderItemInterface;
use App\Interfaces\ShippingMethodInterface;
use App\Interfaces\WishlistInterface;
use App\Interfaces\ProductStatusInterface;
use App\Interfaces\UserLoginHistoryInterface;
use App\Interfaces\BannerInterface;
use App\Interfaces\NewsletterSubscriptionEmailInterface;
use App\Interfaces\ContentPageInterface;
use App\Interfaces\SocialMediaInterface;
use App\Interfaces\AdSectionInterface;
use App\Interfaces\AdItemInterface;
use App\Interfaces\ProductBadgeInterface;
use App\Interfaces\ProductBadgeCombinationInterface;
use App\Interfaces\ProductHighlightInterface;
use App\Interfaces\ProductFaqInterface;
use App\Interfaces\CouponInterface;
use App\Interfaces\CouponUsageInterface;
use App\Interfaces\PaymentGatewayInterface;
use App\Interfaces\OrderShippingTrackingInterface;
use App\Interfaces\OrderStatusHistoryInterface;
use App\Interfaces\OrderStatusInterface;

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
use App\Repositories\CartSettingRepository;
use App\Repositories\AddressRepository;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\ShippingMethodRepository;
use App\Repositories\WishlistRepository;
use App\Repositories\ProductStatusRepository;
use App\Repositories\UserLoginHistoryRepository;
use App\Repositories\BannerRepository;
use App\Repositories\NewsletterSubscriptionEmailRepository;
use App\Repositories\ContentPageRepository;
use App\Repositories\SocialMediaRepository;
use App\Repositories\AdSectionRepository;
use App\Repositories\AdItemRepository;
use App\Repositories\ProductBadgeRepository;
use App\Repositories\ProductBadgeCombinationRepository;
use App\Repositories\ProductHighlightRepository;
use App\Repositories\ProductFaqRepository;
use App\Repositories\CouponRepository;
use App\Repositories\CouponUsageRepository;
use App\Repositories\PaymentGatewayRepository;
use App\Repositories\OrderShippingTrackingRepository;
use App\Repositories\OrderStatusHistoryRepository;
use App\Repositories\OrderStatusRepository;

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
        $this->app->bind(ApplicationSettingInterface::class, ApplicationSettingRepository::class);
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
        $this->app->bind(CartSettingInterface::class, CartSettingRepository::class);
        $this->app->bind(AddressInterface::class, AddressRepository::class);
        $this->app->bind(PaymentMethodInterface::class, PaymentMethodRepository::class);
        $this->app->bind(OrderInterface::class, OrderRepository::class);
        $this->app->bind(OrderItemInterface::class, OrderItemRepository::class);
        $this->app->bind(ShippingMethodInterface::class, ShippingMethodRepository::class);
        $this->app->bind(WishlistInterface::class, WishlistRepository::class);
        $this->app->bind(ProductStatusInterface::class, ProductStatusRepository::class);
        $this->app->bind(UserLoginHistoryInterface::class, UserLoginHistoryRepository::class);
        $this->app->bind(BannerInterface::class, BannerRepository::class);
        $this->app->bind(NewsletterSubscriptionEmailInterface::class, NewsletterSubscriptionEmailRepository::class);
        $this->app->bind(ContentPageInterface::class, ContentPageRepository::class);
        $this->app->bind(SocialMediaInterface::class, SocialMediaRepository::class);
        $this->app->bind(AdSectionInterface::class, AdSectionRepository::class);
        $this->app->bind(AdItemInterface::class, AdItemRepository::class);
        $this->app->bind(ProductBadgeInterface::class, ProductBadgeRepository::class);
        $this->app->bind(ProductBadgeCombinationInterface::class, ProductBadgeCombinationRepository::class);
        $this->app->bind(ProductHighlightInterface::class, ProductHighlightRepository::class);
        $this->app->bind(ProductFaqInterface::class, ProductFaqRepository::class);
        $this->app->bind(CouponInterface::class, CouponRepository::class);
        $this->app->bind(CouponUsageInterface::class, CouponUsageRepository::class);
        $this->app->bind(PaymentGatewayInterface::class, PaymentGatewayRepository::class);
        $this->app->bind(OrderShippingTrackingInterface::class, OrderShippingTrackingRepository::class);
        $this->app->bind(OrderStatusHistoryInterface::class, OrderStatusHistoryRepository::class);
        $this->app->bind(OrderStatusInterface::class, OrderStatusRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
