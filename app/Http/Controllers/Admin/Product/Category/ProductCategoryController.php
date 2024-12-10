<?php

namespace App\Http\Controllers\Admin\Product\Category;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductCategoryController
{
    public function index(): View
    {
        return view('admin.product.category.index');
    }

    public function create(): View
    {
        return view('admin.product.category.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'image' => 'nullable|image|max:1000',
            'title' => 'required|min:2|max:255',
            'level' => 'required|in:1,2,3,4',
            'parent_id' => 'nullable',
        ]);

        
    }
}
