<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\BannerInterface;
use App\Interfaces\ProductFeatureInterface;

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
        $banners = $this->bannerRepository->list('', ['status' => 1], 'all', 'position', 'asc');
        $featuredProducts = $this->productFeatureRepository->list('', [], 'all', 'position', 'asc');

        return view('front.home.index', [
            'banners' => $banners['data'],
            'featuredProducts' => $featuredProducts['data']
        ]);
    }
}
