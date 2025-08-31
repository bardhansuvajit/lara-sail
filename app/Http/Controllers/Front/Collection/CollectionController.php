<?php

namespace App\Http\Controllers\Front\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\ProductCollectionInterface;
use App\Interfaces\ProductFeatureInterface;
use Illuminate\Support\Facades\Cache;

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
            ->whereJsonContains('collection_ids', (int)$collections->id)
            ->whereHas('statusDetail', function ($q) {
                $q->where('allow_order', 1);
            })
            ->with(['category', 'images', 'variations', 'pricings']);

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

        // OPTIONAL - Attributes filtering (keep your existing approach)
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

        // OPTIONAL - Rating filter uses Product::average_rating column (you have this in the model)
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

        // $query = \App\Models\Product::with(['statusDetail', 'category', 'activeImages', 'variations', 'pricings'])
        //     ->whereJsonContains('collection_ids', (int)$collections->id)
        //     ->whereHas('statusDetail', function ($q) {
        //         $q->where('allow_order', 1);
        //     })
        //     ->paginate(16);

        return view('front.collection.detail', [
            'sortByArr' => $sortByArr,
            'collection' => $collections,
            'filters' => $request->all(),
            'products' => $products ?? collect(),
            'featuredProducts' => collect(),
            'minPriceValue' => 0,
            'maxPriceValue' => 20000,
            'stepPrice' => 2000,
        ]);
    }
}
