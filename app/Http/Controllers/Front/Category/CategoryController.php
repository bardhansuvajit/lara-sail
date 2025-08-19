<?php

namespace App\Http\Controllers\Front\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
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
        /*
        $search = $request->input('search');

        $query = ProductCategory::whereNull('parent_id')
            ->where('status', 1);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('short_description', 'like', '%' . $search . '%')
                    ->orWhere('tags', 'like', '%' . $search . '%');
        }

        $categories = $query->orderBy('position')->get();
        */


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

        // ADVERTISEMENT
        $categoryPageAds = Cache::remember('category_ads', now()->addHours(6), function() {
            return $this->adSectionRepository->list('', ['page' => 'category', 'status' => 1], 'all', 'position', 'asc');
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










        /** OLD CODE */
        /*
        $search = $request->input('search');

        $query = ProductCategory::whereNull('parent_id')
            ->where('status', 1);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('tags', 'like', '%' . $search . '%');
        }

        $categories = $query->with([
            'childDetails' => function ($q) {
                $q->where('status', 1) // only active children
                ->withCount('products')
                ->with([
                    'childDetails' => function ($qq) {
                        $qq->where('status', 1) // only active sub-children
                            ->withCount('products')
                            ->select('id', 'title as name', 'image_m as image', 'slug', 'parent_id');
                    }
                ])
                ->select('id', 'title as name', 'image_m as image', 'slug', 'parent_id');
            },
        ])
        ->withCount('products')
        ->select('id', 'title as name', 'image_m as image', 'short_description as description', 'slug')
        ->get()
        ->map(function ($cat) {
            return [
                'name' => $cat->name,
                'slug' => $cat->slug,
                'image' => $cat->image,
                'description' => $cat->description,
                'children' => $cat->childDetails->map(function ($child) {
                    return [
                        'name' => $child->name,
                        'slug' => $child->slug,
                        'image' => $child->image,
                        'products_count' => $child->products_count ?? 0,
                        'children' => $child->childDetails->map(function ($sub) {
                            return [
                                'name' => $sub->name,
                                'slug' => $sub->slug,
                                'image' => $sub->image,
                                'products_count' => $sub->products_count ?? 0,
                            ];
                        })->toArray(),
                    ];
                })->toArray(),
            ];
        })
        ->toArray();

        return view('front.category.index', [
            'categories' => $categories
        ]);
        */
    }

    public function detail(Request $request, $slug): View
    {
        $categoryDetailData = $this->productCategoryRepository->getBySlug($slug);
        $category = $categoryDetailData['data'];

        // Load products
        // $products = $category->getAllActiveProductsAttribute()
        //     ->with(['brand', 'images']) // eager load for performance
        //     ->paginate(12);

        return view('front.category.detail', [
            'category' => $category,
            'activeProductsCount' => $category->all_active_products->count(),
            'products' => $products
        ]);
    }
}
