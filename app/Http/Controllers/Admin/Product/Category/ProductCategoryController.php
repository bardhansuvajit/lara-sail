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
}
