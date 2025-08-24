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

    public function detail(Request $request, $slug): View|RedirectResponse
    {
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

        // Static Country ID
        $countryId = 82;

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



        // ---------- dynamic price range & step (place after $categoryIds) ----------
/**
 * Compute a 'nice' step for price slider.
 */
$niceStep = function (float $min, float $max, int $buckets = 10): float {
    if ($max <= $min) {
        // fallback
        return max(1, round(($max > 0 ? $max : 100) / $buckets));
    }

    $raw = ($max - $min) / $buckets;
    if ($raw <= 0) return 1;

    $pow = pow(10, floor(log10($raw)));
    $f = $raw / $pow;

    if ($f < 1.5) $nice = 1;
    elseif ($f < 3) $nice = 2;
    elseif ($f < 7) $nice = 5;
    else $nice = 10;

    return $nice * $pow;
};

// Get the effective selling price for each product (country-specific preferred, then NULL)
$effectivePrices = DB::table('product_pricings')
    ->select('product_id', 'selling_price')
    ->whereIn('product_id', function ($q) use ($categoryIds) {
        $q->select('id')->from('products')->whereIn('category_id', $categoryIds);
    })
    ->where(function ($q) use ($countryId) {
        $q->where('country_id', $countryId)->orWhereNull('country_id');
    })
    ->orderByRaw('CASE WHEN country_id = ? THEN 0 WHEN country_id IS NULL THEN 1 ELSE 2 END', [$countryId])
    ->orderBy('selling_price')
    ->get()
    ->groupBy('product_id')
    ->map(function ($prices) {
        // For each product, take the first price (which is the preferred one)
        return $prices->first()->selling_price;
    });

// Get min and max from the effective prices
if ($effectivePrices->isNotEmpty()) {
    $minSelling = (float) $effectivePrices->min();
    $maxSelling = (float) $effectivePrices->max();
} else {
    // fallback static values
    $minSelling = 100.0;
    $maxSelling = 10000.0;
}

// if min > max accidentally swap
if ($minSelling > $maxSelling) {
    [$minSelling, $maxSelling] = [$maxSelling, $minSelling];
}

// compute a nice step and align min/max to multiples of step
$step = $niceStep($minSelling, $maxSelling, 10);

// avoid 0 step
if ($step <= 0) $step = 1;

// round min down, max up to step multiples
$minAligned = floor($minSelling / $step) * $step;
$maxAligned = ceil($maxSelling / $step) * $step;

// ensure minAligned < maxAligned
if ($minAligned == $maxAligned) {
    // expand range a bit
    $minAligned = max(0, $minAligned - $step);
    $maxAligned = $maxAligned + $step;
}

// cast to int if you prefer integers
$minPriceValue = (int) $minAligned;
$maxPriceValue = (int) $maxAligned;
$stepPrice = (int) $step;
// ---------- end dynamic price range & step ----------



        // Build a subquery that resolves the product's "final" price (country-specific preferred)
        $pricingSub = DB::table('product_pricings')
            ->select('selling_price')
            ->whereColumn('product_pricings.product_id', 'products.id')
            ->where(function ($q) use ($countryId) {
                if ($countryId) {
                    // prefer exact country row, but allow NULL fallback
                    $q->where('country_id', $countryId)->orWhereNull('country_id');
                } else {
                    // if no country context, only use the NULL-country pricing rows
                    $q->whereNull('country_id');
                }
            })
            // Ensure exact-country rows come first, then NULL rows
            ->orderByRaw('CASE WHEN country_id = ? THEN 0 WHEN country_id IS NULL THEN 1 ELSE 2 END', [$countryId])
            ->limit(1);

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

        return view('front.category.detail', [
            'sortByArr' => $sortByArr,
            'category' => $category,
            'subcategories' => $category->childDetails,
            'activeProductsCount' => $category->total_active_products_count,
            'products' => $products,
            'attributes' => $attributes,
            'filters' => $request->all(),
            'minPriceValue' => $minPriceValue,
            'maxPriceValue' => $maxPriceValue,
            'stepPrice' => $stepPrice,
            // 'minPriceValue' => 100,
            // 'maxPriceValue' => 10000,
            // 'stepPrice' => 1000,
        ]);
    }

}
