<?php

namespace App\Http\Controllers\Front\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

use App\Interfaces\ProductCategoryInterface;
use App\Interfaces\ProductFeatureInterface;
use App\Interfaces\AdSectionInterface;

class CategoryController extends Controller
{
    private ProductCategoryInterface $productCategoryRepository;
    private ProductFeatureInterface $productFeatureRepository;
    private AdSectionInterface $adSectionRepository;

    public function __construct(
        ProductCategoryInterface $productCategoryRepository,
        ProductFeatureInterface $productFeatureRepository,
        AdSectionInterface $adSectionRepository
    )
    {
        $this->productCategoryRepository = $productCategoryRepository;
        $this->productFeatureRepository = $productFeatureRepository;
        $this->adSectionRepository = $adSectionRepository;
    }

    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search', ''));

        // Columns to fetch (keep minimal)
        $cols = ['id', 'title', 'slug', 'short_description', 'parent_id', 'status', 'position', 'image_s', 'image_m'];

        // Base builder with status + selected columns
        $base = ProductCategory::query()
            ->select($cols)
            ->where('status', 1)
            ->when($search, function ($q) use ($search) {
                // Prefer full-text if available, otherwise fallback to grouped LIKEs
                if (method_exists($q, 'whereFullText')) {
                    $q->whereFullText(['title', 'short_description', 'tags'], $search);
                } else {
                    $q->where(function ($q2) use ($search) {
                        $like = "%{$search}%";
                        $q2->where('title', 'like', $like)
                        ->orWhere('short_description', 'like', $like)
                        ->orWhere('tags', 'like', $like);
                    });
                }
            });

        $parentsQuery = (clone $base)
            ->whereNull('parent_id')
            ->withCount('childDetails', 'activeProducts') // optional: children count
            ->orderBy('position');

        $childrenQuery = (clone $base)
            ->whereNotNull('parent_id')
            ->orderBy('position');

        // Pagination (tweak per your UI: 24 is a common desktop page size)
        $parents = $parentsQuery->paginate(24)->appends($request->only('search'));
        $children = $childrenQuery->paginate(100)->appends($request->only('search'));


        // dd($categories->pluck('title'));

        // Featured products
        $featuredProducts = $this->productFeatureRepository->list('', [], 'all', 'position', 'asc');

        // Featured + Flash Sale + Trending Products
        $productFeatures = Cache::remember('homepage_products', now()->addHours(6), function() {
            return $this->productFeatureRepository->listAllFeatured();
        });

        return view('front.category.index', [
            'catCount' => count($parents),
            'parents' => $parents,
            'children' => $children,
            'featuredProducts' => $featuredProducts['data'],

            'flashSaleProducts' => $productFeatures['data']['flash'] ?? [],

            'categoryPageAd1' => $categoryPageAds['data'][0]->activeItemOnly ?? [],
            'categoryPageAd2' => $categoryPageAds['data'][1]->activeItemOnly ?? [],
            'categoryPageAd3' => $categoryPageAds['data'][2]->activeItemOnly ?? [],
        ]);
    }

    public function detail(Request $request, $slug): View|RedirectResponse
    {
        $displayProductsPerPage = 16;
        $sortByArr = [
            'relevance' => 'Relevance',
            'price_asc' => 'Price: Low to High',
            'price_desc' => 'Price: High to Low',
            'newest' => 'Newest',
            'rating' => 'Top rated',
        ];

        $categoryDetailData = $this->productCategoryRepository->getBySlug($slug);

        if ($categoryDetailData['code'] == 200) {
            $category = $categoryDetailData['data'];

            // Get paginated products from this category and all its children
            $perPage = $request->get('per_page', $displayProductsPerPage);
            $products = $category->getPaginatedProductsFromCategoryAndChildren($perPage);

            return view('front.category.detail', [
                'sortByArr' => $sortByArr,
                'category' => $category,
                'subcategories' => $category->childDetails,
                'activeProductsCount' => $category->total_active_products_count,
                'products' => $products
            ]);
        } else {
            return redirect()->route('front.error.404');
        }
    }

    public function showWithFilters($slug, Request $request)
    {
        // Find the category by slug
        $category = ProductCategory::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
        
        // Get category IDs including all descendants
        $categoryIds = $category->getDescendantCategoryIds();
        
        // Build the base query
        $query = Product::whereIn('category_id', $categoryIds)
            ->whereHas('statusDetail', function ($query) {
                $query->where('allow_order', 1);
            })
            ->with(['category', 'images', 'variations']);
        
        // Apply filters if needed
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        
        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'popular':
                    $query->orderBy('views', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        // Get paginated results
        $perPage = $request->get('per_page', 15);
        $products = $query->paginate($perPage);
        
        return view('category.show', compact('category', 'products'));
    }
}
