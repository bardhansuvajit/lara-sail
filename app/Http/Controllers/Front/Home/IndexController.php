<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\BannerInterface;
use App\Interfaces\ProductFeatureInterface;

use App\Models\ProductCategory;

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

        $cats = ProductCategory::active()->with('activeChildrenByPosition')
                    ->whereNull('parent_id') // Level 1
                    ->orderBy('position')
                    ->get()
                    ->toArray();

        return view('front.home.index', [
            'banners' => $banners['data'],
            'featuredProducts' => $featuredProducts['data'],
            'cats' => $cats
        ]);
    }
}
