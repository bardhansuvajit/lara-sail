<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\BannerInterface;
use App\Interfaces\ProductFeatureInterface;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    private BannerInterface $bannerRepository;
    private ProductFeatureInterface $productFeatureRepository;

    public function __construct(
        BannerInterface $bannerRepository,
        ProductFeatureInterface $productFeatureRepository
    )
    {
        $this->bannerRepository = $bannerRepository;
        $this->productFeatureRepository = $productFeatureRepository;
    }

    public function index(): View
    {
        Cache::forget('homepage_products');

        $banners = $this->bannerRepository->list('', ['status' => 1], 'all', 'position', 'asc');

        $productFeatures = Cache::remember('homepage_products', now()->addHours(6), function() {
            return $this->productFeatureRepository->listAllFeatured();
        });

        return view('front.home.index', [
            'banners' => $banners['data'],
            'featuredProducts' => $productFeatures['data']['featured'] ?? [],
            'flashSaleProducts' => $productFeatures['data']['flash'] ?? [],
            'trendingProducts' => $productFeatures['data']['trending'] ?? [],
        ]);
    }
}
