<?php

namespace App\Http\Controllers\Admin\Product\Listing;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductListingController
{
    public function index(): View
    {
        return view('admin.product.listing.index');
    }

    public function create(): View
    {
        return view('admin.product.listing.create');
    }
}
