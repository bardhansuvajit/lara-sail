<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\BannerInterface;
use App\Interfaces\ProductFeatureInterface;
use App\Interfaces\ProductListingInterface;
use App\Interfaces\AdSectionInterface;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    private BannerInterface $bannerRepository;
    private ProductFeatureInterface $productFeatureRepository;
    private ProductListingInterface $productListingRepository;
    private AdSectionInterface $adSectionRepository;

    public function __construct(
        BannerInterface $bannerRepository,
        ProductFeatureInterface $productFeatureRepository,
        ProductListingInterface $productListingRepository,
        AdSectionInterface $adSectionRepository
    )
    {
        $this->bannerRepository = $bannerRepository;
        $this->productFeatureRepository = $productFeatureRepository;
        $this->productListingRepository = $productListingRepository;
        $this->adSectionRepository = $adSectionRepository;
    }

    public function index(): View
    {
        $categoryStyleCount = 5;
        $defaultMostSoldProductLoad = 8;

        // Cache::forget('homepage_products');
        // Cache::forget('most_sold_products');
        // Cache::forget('homepage_ads');

        // Banners
        $banners = $this->bannerRepository->list('', ['status' => 1], 'all', 'position', 'asc');

        // Featured + Flash Sale + Trending Products
        $productFeatures = Cache::remember('homepage_products', now()->addHours(6), function() {
            return $this->productFeatureRepository->listAllFeatured();
        });

        // Most Sold Products
        $flashItems = data_get($productFeatures, 'data.flash', []);
        $flashCount = is_countable($flashItems) ? count($flashItems) : 0;

        if ($flashCount > 3) {
            $mostSoldFeatures = ['data' => []];
        } else {
            $load = ($flashCount > 0 && $flashCount < 3) ? 3 : $defaultMostSoldProductLoad;
            $cacheKey = "most_sold_products";

            $mostSoldFeatures = Cache::remember($cacheKey, now()->addHours(6), function () use ($load) {
                return $this->productListingRepository->list('', ['status' => 1], $load, 'sold_count', 'asc');
            });
        }

        // ADVERTISEMENT
        $homepageAds = Cache::remember('homepage_ads', now()->addHours(6), function() {
            return $this->adSectionRepository->list('', ['page' => 'homepage', 'status' => 1], 'all', 'position', 'asc');
        });

        return view('front.home.index', [
            'categoryStyleCount' => $categoryStyleCount, // show max no of category
            'banners' => $banners['data'],
            'featuredProducts' => $productFeatures['data']['featured'] ?? [],
            'flashSaleProducts' => $productFeatures['data']['flash'] ?? [],
            'trendingProducts' => $productFeatures['data']['trending'] ?? [],
            'mostSoldFeatures' => $mostSoldFeatures['data'] ?? [],

            'homepageAd1' => $homepageAds['data'][0]->activeItemOnly ?? [],
            'homepageAd2' => $homepageAds['data'][1]->activeItemOnly ?? [],
            'homepageAd3' => $homepageAds['data'][2]->activeItemOnly ?? [],
        ]);
    }
}
