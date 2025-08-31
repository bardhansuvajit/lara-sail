<?php

namespace App\Http\Controllers\Front\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\ProductCollectionInterface;
use App\Interfaces\ProductFeatureInterface;
use Illuminate\Support\Facades\Cache;

use App\Models\Product;
use App\Models\ProductCollection;

class CollectionController
{
    private ProductCollectionInterface $productCollectionRepository;
    private ProductFeatureInterface $productFeatureRepository;

    public function __construct(
        ProductCollectionInterface $productCollectionRepository,
        ProductFeatureInterface $productFeatureRepository
    )
    {
        $this->productCollectionRepository = $productCollectionRepository;
        $this->productFeatureRepository = $productFeatureRepository;
    }

    public function index(Request $request) : View
    {
        $search = trim((string) $request->input('search', ''));

        // dd($search);

        if (!empty($search)) {
            $collections = $this->productCollectionRepository->list($search, ['status' => 1], 'all', 'position', 'asc');
        } else {
            $collections = $this->productCollectionRepository->list('', ['status' => 1], 'all', 'position', 'asc');
        }

        // Featured + Flash Sale + Trending Products
        $productFeatures = Cache::remember('homepage_products', now()->addHours(6), function() {
            return $this->productFeatureRepository->listAllFeatured();
        });

        return view('front.collection.index', [
            'collections' => $collections['data'] ?? [],
            'featuredProducts' => $productFeatures['data']['featured'] ?? [],
            'flashSaleProducts' => $productFeatures['data']['flash'] ?? [],
            'trendingProducts' => $productFeatures['data']['trending'] ?? [],
        ]);
    }

    public function detail(Request $request, string $slug): View
    {
        // Static Country ID
        $countryId = 82;
        $displayProductsPerPage = 16;

        $sortByArr = [
            'relevance'   => 'Relevance',
            'price_asc'   => 'Price: Low to High',
            'price_desc'  => 'Price: High to Low',
            'newest'      => 'Newest',
            'rating'      => 'Top rated',
        ];

        $collectionData = $this->productCollectionRepository->getBySlug($slug);

        if ($collectionData['code'] !== 200) {
            return redirect()->route('front.error.404');
        }

        $collections = $collectionData['data'];

        // Products per page
        $perPage = (int) $request->get('per_page', $displayProductsPerPage);
        if ($perPage <= 0) $perPage = $displayProductsPerPage;

        // Filters from request
        $priceMin = $request->input('min_price');
        $priceMax = $request->input('max_price');
        $selectedCategories = (array) $request->input('category', []);
        $sortBy = $request->input('sortBy', null);
        $rating = $request->input('rating', null);
        $attrs = (array) $request->input('attrs', []);

        // Products
        $products = Product::with(['statusDetail', 'category', 'activeImages', 'variations', 'pricings'])
            ->whereJsonContains('collection_ids', (int)$collections->id)
            ->whereHas('statusDetail', function ($q) {
                $q->where('allow_order', 1);
            })
            ->paginate(16);

        return view('front.collection.detail', [
            'sortByArr' => $sortByArr,
            'collection' => $collections,
            'products' => $products ?? collect(),
            'featuredProducts' => collect(),
            'minPriceValue' => 0,
            'maxPriceValue' => 20000,
            'stepPrice' => 2000,
        ]);
    }
}
