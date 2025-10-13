<?php

namespace App\Http\Controllers\Front\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\ProductFeatureInterface;
use App\Interfaces\ProductListingInterface;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCollection;

class SearchController extends Controller
{
    private ProductFeatureInterface $productFeatureRepository;
    private ProductListingInterface $productListingRepository;

    public function __construct(
        ProductFeatureInterface $productFeatureRepository,
        ProductListingInterface $productListingRepository
    ) {
        $this->productFeatureRepository = $productFeatureRepository;
        $this->productListingRepository = $productListingRepository;
    }

    public function index(Request $request): View|RedirectResponse
    {
        // read query param
        $query = (string) $request->input('q', '');

        if (trim($query) === '') {
            return redirect()->back();
        }

        // Featured products for the top of page (cached)
        $productFeatures = Cache::remember('homepage_products', now()->addHours(6), function () {
            return $this->productFeatureRepository->listFeaturedOnly('featured');
        });

        $searchProducts = Product::where('title', 'like', "%{$query}%")
            ->orWhere('search_tags', 'like', "%{$query}%")
            ->with('activeImages', 'statusDetail')
            ->whereHas('statusDetail', function ($q) {
                $q->where('show_in_frontend', 1);
            })
            ->paginate(18);

        // Also search categories & collections (limit to reasonable number)
        $searchCategories = ProductCategory::where('title', 'like', "%{$query}%")
            ->orWhere('tags', 'like', "%{$query}%")
            ->where('status', 1)
            ->limit(12)
            ->get();

        $searchCollections = ProductCollection::where('title', 'like', "%{$query}%")
            ->orWhere('tags', 'like', "%{$query}%")
            ->where('status', 1)
            ->limit(12)
            ->get();

        return view('front.search.index', [
            'featuredProducts'   => $productFeatures['data'] ?? [],
            'searchProducts'     => $searchProducts,
            'searchCategories'   => $searchCategories,
            'searchCollections'  => $searchCollections,
            'query'              => $query,
        ]);
    }
}
