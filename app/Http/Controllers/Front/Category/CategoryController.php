<?php

namespace App\Http\Controllers\Front\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $query = ProductCategory::whereNull('parent_id')
            ->where('status', 1);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
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
}
