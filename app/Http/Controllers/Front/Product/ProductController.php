<?php

namespace App\Http\Controllers\Front\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\ProductListingInterface;

class ProductController extends Controller
{
    private ProductListingInterface $productListingRepository;

    public function __construct(ProductListingInterface $productListingRepository)
    {
        $this->productListingRepository = $productListingRepository;
    }

    public function detail($slug): RedirectResponse|View
    {
        $resp = $this->productListingRepository->getBySlug($slug);
        if ($resp['code'] == 200) {
            return view('front.product.detail', [
                'product' => $resp['data']
            ]);
        } else {
            return redirect()->route('front.error.404');
        }
    }
}
