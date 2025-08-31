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
        
        // More selective eager loading
        $parentRelations = [
            'childDetails', // Only if actually used in the view
            'activeProducts' => function($query) {
                $query->select('id', 'category_id'); // Only what's needed
            }
        ];

        $childRelations = [
            'activeProducts' => function($query) {
                $query->select('id', 'category_id'); // Only what's needed
            }
        ];

        $cols = ['id', 'title', 'slug', 'short_description', 'parent_id', 'status', 'position', 'image_s', 'image_m'];

        $base = ProductCategory::query()
            ->select($cols)
            ->where('status', 1)
            ->when($search, function ($q) use ($search) {
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

        // Use withCount instead of loading relationships for counting
        $parentsQuery = (clone $base)
            ->whereNull('parent_id')
            ->with($parentRelations)
            ->withCount(['childDetails', 'activeProducts']) // Use counts instead of loading
            ->orderBy('position');

        $childrenQuery = (clone $base)
            ->whereNotNull('parent_id')
            ->withCount(['activeProducts']) // Use count instead of loading
            ->orderBy('position');

        $parents = $parentsQuery->paginate(24)->appends($request->only('search'));
        $children = $childrenQuery->paginate(100)->appends($request->only('search'));

        // Cache only if not searching
        if (empty($search)) {
            $cachedData = Cache::remember('category_page_data', now()->addHours(6), function() {
                return [
                    'featured_products' => $this->productFeatureRepository->list('', [], 'all', 'position', 'asc'),
                    'all_featured' => $this->productFeatureRepository->listAllFeatured(),
                    'category_ads' => $this->adSectionRepository->list('category', ['status' => 1], 'all', 'position', 'asc')
                ];
            });
        } else {
            // Don't cache search results
            $cachedData = [
                'featured_products' => $this->productFeatureRepository->list('', [], 'all', 'position', 'asc'),
                'all_featured' => $this->productFeatureRepository->listAllFeatured(),
                'category_ads' => $this->adSectionRepository->list('category', ['status' => 1], 'all', 'position', 'asc')
            ];
        }

        return view('front.category.index', [
            'catCount' => $parents->total(),
            'parents' => $parents,
            'children' => $children,
            'featuredProducts' => $cachedData['featured_products']['data'] ?? [],
            'flashSaleProducts' => $cachedData['all_featured']['data']['flash'] ?? [],
            'categoryPageAds' => $cachedData['category_ads']['data'] ?? [],
            'hasSearch' => !empty($search)
        ]);
    }

    /*
    CHAPGPT CODE
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search', ''));
        $cols = ['id', 'title', 'slug', 'short_description', 'parent_id', 'status', 'position', 'image_s', 'image_m'];

        // Base query (status + search) — keep selection to minimal columns
        $base = ProductCategory::query()
            ->select($cols)
            ->where('status', 1)
            ->when($search, function ($q) use ($search) {
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

        // Parents: we need counts but don't need to hydrate child models
        $parentsQuery = (clone $base)
            ->whereNull('parent_id')
            ->withCount(['childDetails', 'activeProducts']) // counts only, avoids loading full relations
            ->orderBy('position');

        // Children: get children and their active products count (avoid loading activeProducts models)
        $childrenQuery = (clone $base)
            ->whereNotNull('parent_id')
            ->withCount('activeProducts') // provides active_products_count attribute
            ->orderBy('position');

        // Paginate (keep existing page sizes)
        $parents = $parentsQuery->paginate(24)->appends($request->only('search'));
        $children = $childrenQuery->paginate(100)->appends($request->only('search'));

        // Featured products (keep existing repo calls & caching)
        $featuredProducts = $this->productFeatureRepository->list('', [], 'all', 'position', 'asc');

        // Featured + Flash Sale + Trending Products (cached)
        $productFeatures = Cache::remember('homepage_products', now()->addHours(6), function() {
            return $this->productFeatureRepository->listAllFeatured();
        });

        // ADVERTISEMENT (cached)
        $categoryPageAds = Cache::remember('categorypage_ads', now()->addHours(6), function() {
            return $this->adSectionRepository->list('category', ['status' => 1], 'all', 'position', 'asc');
        });

        return view('front.category.index', [
            'catCount' => $parents->total(), // use paginator total() instead of count($parents)
            'parents' => $parents,
            'children' => $children,
            'featuredProducts' => $featuredProducts['data'] ?? [],

            'flashSaleProducts' => $productFeatures['data']['flash'] ?? [],

            'categoryPageAd1' => $categoryPageAds['data'][0]->activeItemOnly ?? [],
            'categoryPageAd2' => $categoryPageAds['data'][1]->activeItemOnly ?? [],
            'categoryPageAd3' => $categoryPageAds['data'][2]->activeItemOnly ?? [],
        ]);
    }
    */

    /*
    OLD CODE
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search', ''));

        $cols = ['id', 'title', 'slug', 'short_description', 'parent_id', 'status', 'position', 'image_s', 'image_m'];

        $base = ProductCategory::query()
            ->select($cols)
            ->where('status', 1)
            ->when($search, function ($q) use ($search) {
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
            ->withCount('childDetails', 'activeProducts')
            ->orderBy('position');

        $childrenQuery = (clone $base)
            ->whereNotNull('parent_id')
            ->orderBy('position');

        $parents = $parentsQuery->paginate(24)->appends($request->only('search'));
        $children = $childrenQuery->paginate(100)->appends($request->only('search'));


        // Featured products
        $featuredProducts = $this->productFeatureRepository->list('', [], 'all', 'position', 'asc');

        // Featured + Flash Sale + Trending Products
        $productFeatures = Cache::remember('homepage_products', now()->addHours(6), function() {
            return $this->productFeatureRepository->listAllFeatured();
        });

        // ADVERTISEMENT
        $categoryPageAds = Cache::remember('categorypage_ads', now()->addHours(6), function() {
            return $this->adSectionRepository->list('category', ['status' => 1], 'all', 'position', 'asc');
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
    */

    public function detail(Request $request, $slug): View|RedirectResponse
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

        // Category Details
        $categoryDetailData = $this->productCategoryRepository->getBySlug($slug);

        if ($categoryDetailData['code'] !== 200) {
            return redirect()->route('front.error.404');
        }

        $category = $categoryDetailData['data'];

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

        // Descendant category ids (uses your existing model method)
        $categoryIds = $category->getDescendantCategoryIds();

        // If user selected subcategories, sanitize + restrict to descendants
        $selCatIds = array_filter(array_map('intval', $selectedCategories));
        if (!empty($selCatIds)) {
            $selCatIds = array_values(array_intersect($selCatIds, $categoryIds));
            if (!empty($selCatIds)) {
                $categoryIds = $selCatIds;
            }
        }

        // Build main products query in controller and include selling_price as a selected subquery alias
        $query = \App\Models\Product::query()
            ->select('products.*')
            ->addSelect([
                'selling_price' => function ($query) use ($countryId) {
                    $query->select('selling_price')
                        ->from('product_pricings')
                        ->whereColumn('product_pricings.product_id', 'products.id')
                        ->where(function ($q) use ($countryId) {
                            if ($countryId) {
                                $q->where('country_id', $countryId)->orWhereNull('country_id');
                            } else {
                                $q->whereNull('country_id');
                            }
                        })
                        ->orderByRaw('CASE WHEN country_id = ? THEN 0 WHEN country_id IS NULL THEN 1 ELSE 2 END', [$countryId])
                        ->limit(1);
                }
            ])
            ->whereIn('category_id', $categoryIds)
            ->whereHas('statusDetail', function ($q) {
                $q->where('allow_order', 1);
            })
            ->with(['category', 'images', 'variations', 'pricings']);

        // $priceMin = $request->input('price_min', $request->input('min_price', null));
        // $priceMax = $request->input('price_max', $request->input('max_price', null));

        // ---------- Price filtering using the computed selling_price (fixed bindings) ----------
        if ($priceMin !== null || $priceMax !== null) {
            $min = $priceMin !== null ? (float) $priceMin : null;
            $max = $priceMax !== null ? (float) $priceMax : null;

            $query->where(function ($q) use ($min, $max, $countryId) {
                if ($min !== null && $max !== null) {
                    if ($min > $max) { [$min, $max] = [$max, $min]; }
                    $q->whereRaw('(SELECT selling_price FROM product_pricings 
                                WHERE product_pricings.product_id = products.id 
                                AND (country_id = ? OR country_id IS NULL) 
                                ORDER BY CASE WHEN country_id = ? THEN 0 WHEN country_id IS NULL THEN 1 ELSE 2 END 
                                LIMIT 1) BETWEEN ? AND ?',
                        [$countryId, $countryId, $min, $max]);
                } elseif ($min !== null) {
                    $q->whereRaw('(SELECT selling_price FROM product_pricings 
                                WHERE product_pricings.product_id = products.id 
                                AND (country_id = ? OR country_id IS NULL) 
                                ORDER BY CASE WHEN country_id = ? THEN 0 WHEN country_id IS NULL THEN 1 ELSE 2 END 
                                LIMIT 1) >= ?',
                        [$countryId, $countryId, $min]);
                } elseif ($max !== null) {
                    $q->whereRaw('(SELECT selling_price FROM product_pricings 
                                WHERE product_pricings.product_id = products.id 
                                AND (country_id = ? OR country_id IS NULL) 
                                ORDER BY CASE WHEN country_id = ? THEN 0 WHEN country_id IS NULL THEN 1 ELSE 2 END 
                                LIMIT 1) <= ?',
                        [$countryId, $countryId, $max]);
                }
            });
        }

        // Attributes filtering (keep your existing approach)
        if (!empty($attrs)) {
            foreach ($attrs as $attrId => $values) {
                $values = array_filter(array_map('intval', (array)$values));
                if (empty($values)) continue;

                $query->whereHas('variations', function ($q) use ($attrId, $values) {
                    // adjust column names if your variation table differs
                    $q->where('attribute_id', (int)$attrId)
                    ->whereIn('attribute_value_id', $values);
                });
            }
        }

        // Rating filter uses Product::average_rating column (you have this in the model)
        if (!empty($rating)) {
            $query->where('average_rating', '>=', (int)$rating);
        }

        // Sorting
        switch ($sortBy) {
            case 'price_asc':
                $query->orderBy('selling_price', 'asc')->orderBy('created_at', 'desc');
                break;
            case 'price_desc':
                $query->orderBy('selling_price', 'desc')->orderBy('created_at', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'rating':
                $query->orderBy('average_rating', 'desc')->orderBy('created_at', 'desc');
                break;
            case 'relevance':
            default:
                $query->orderBy('sold_count', 'asc');
                break;
        }

        // Paginate and preserve query string for links
        $products = $query->paginate($perPage);
        $products->appends($request->except('page'));

        // dd(DB::getQueryLog());

        // Attributes for the filter UI (if you plan to show them)
        $attributes = []; // populate if needed: $category->variationAttributeValues()->with('values')->get();

        // Featured + Flash Sale + Trending Products
        $productFeatures = Cache::remember('homepage_products', now()->addHours(6), function() {
            return $this->productFeatureRepository->listAllFeatured();
        });

        return view('front.category.detail', [
            'sortByArr' => $sortByArr,
            'category' => $category,
            'subcategories' => $category->childDetails,
            'activeProductsCount' => $category->total_active_products_count,
            'products' => $products,
            'attributes' => $attributes,
            'filters' => $request->all(),
            // 'minPriceValue' => $minPriceValue,
            // 'maxPriceValue' => $maxPriceValue,
            'minPriceValue' => 0,
            'maxPriceValue' => 20000,
            'stepPrice' => 2000,
            // 'minPriceValue' => 100,
            // 'maxPriceValue' => 10000,
            // 'stepPrice' => 1000,
            'featuredProducts' => $productFeatures['data']['featured'] ?? [],
            'flashSaleProducts' => $productFeatures['data']['flash'] ?? [],
            'trendingProducts' => $productFeatures['data']['trending'] ?? [],
        ]);
    }

}
