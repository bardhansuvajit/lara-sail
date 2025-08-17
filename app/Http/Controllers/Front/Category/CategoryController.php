<?php

namespace App\Http\Controllers\Front\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ProductFeatureInterface;
use App\Interfaces\AdSectionInterface;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    private ProductFeatureInterface $productFeatureRepository;
    private AdSectionInterface $adSectionRepository;

    public function __construct(
        ProductFeatureInterface $productFeatureRepository,
        AdSectionInterface $adSectionRepository
    )
    {
        $this->productFeatureRepository = $productFeatureRepository;
        $this->adSectionRepository = $adSectionRepository;
    }

    public function index(Request $request): View
    {
        $search = $request->input('search');

        $query = ProductCategory::whereNull('parent_id')
            ->where('status', 1);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('short_description', 'like', '%' . $search . '%')
                    ->orWhere('tags', 'like', '%' . $search . '%');
        }

        $categories = $query->orderBy('position')->get();

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
            'catCount' => count($categories),
            'categories' => $categories,
            'featuredProducts' => $featuredProducts['data'],

            'flashSaleProducts' => $productFeatures['data']['flash'] ?? [],

            'categoryPageAd1' => $categoryPageAds['data'][0]->activeItemOnly ?? [],
            'categoryPageAd2' => $categoryPageAds['data'][1]->activeItemOnly ?? [],
            'categoryPageAd3' => $categoryPageAds['data'][2]->activeItemOnly ?? [],
        ]);










        /** OLD CODE */
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
    }

    public function detail(Request $request): View
    {
        return view('front.category.detail');
    }
}
