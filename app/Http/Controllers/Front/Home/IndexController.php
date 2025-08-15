<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\BannerInterface;
use App\Interfaces\ProductFeatureInterface;
use App\Interfaces\ProductListingInterface;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    private BannerInterface $bannerRepository;
    private ProductFeatureInterface $productFeatureRepository;
    private ProductListingInterface $productListingRepository;

    public function __construct(
        BannerInterface $bannerRepository,
        ProductFeatureInterface $productFeatureRepository,
        ProductListingInterface $productListingRepository
    )
    {
        $this->bannerRepository = $bannerRepository;
        $this->productFeatureRepository = $productFeatureRepository;
        $this->productListingRepository = $productListingRepository;
    }

    public function index(): View
    {
        Cache::forget('homepage_products');
        Cache::forget('most_sold_products');

        $banners = $this->bannerRepository->list('', ['status' => 1], 'all', 'position', 'asc');

        $productFeatures = Cache::remember('homepage_products', now()->addHours(6), function() {
            return $this->productFeatureRepository->listAllFeatured();
        });

        $mostSoldFeatures = Cache::remember('most_sold_products', now()->addHours(6), function() {
            return $this->productListingRepository->list('', ['status' => 1], '3', 'sold_count', 'asc');
        });

        return view('front.home.index', [
            'categoryStyleCount' => 5, // show max no of category
            'banners' => $banners['data'],
            'featuredProducts' => $productFeatures['data']['featured'] ?? [],
            'flashSaleProducts' => $productFeatures['data']['flash'] ?? [],
            'trendingProducts' => $productFeatures['data']['trending'] ?? [],
            'mostSoldFeatures' => $mostSoldFeatures['data'] ?? [],
        ]);
    }
}
