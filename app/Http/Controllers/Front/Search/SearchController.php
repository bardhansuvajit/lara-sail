<?php

namespace App\Http\Controllers\Front\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\ProductFeatureInterface;
use App\Interfaces\ProductListingInterface;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    private ProductFeatureInterface $productFeatureRepository;
    private ProductListingInterface $productListingRepository;

    public function __construct(ProductFeatureInterface $productFeatureRepository, ProductListingInterface $productListingRepository)
    {
        $this->productFeatureRepository = $productFeatureRepository;
        $this->productListingRepository = $productListingRepository;
    }

    public function index(Request $request): View
    {
        $query = $request->q;
        if (empty($request->query)) {
            return redirect()->back();
        }

        // Featured + Flash Sale + Trending Products
        $productFeatures = Cache::remember('homepage_products', now()->addHours(6), function() {
            return $this->productFeatureRepository->listFeaturedOnly('featured');
        });

        $searchProducts = $this->productListingRepository->list($query, [], 'all', 'sold_count', 'asc');

        return view('front.search.index', [
            'featuredProducts' => $productFeatures['data'] ?? [],
            'searchProducts' => $searchProducts['data'],
        ]);
    }

}
