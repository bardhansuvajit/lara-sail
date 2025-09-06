<?php

namespace App\Http\Controllers\Front\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\ProductListingInterface;
use App\Interfaces\ProductVariationInterface;

class ProductController extends Controller
{
    private ProductListingInterface $productListingRepository;
    private ProductVariationInterface $productVariationRepository;

    public function __construct(ProductListingInterface $productListingRepository, ProductVariationInterface $productVariationRepository)
    {
        $this->productListingRepository = $productListingRepository;
        $this->productVariationRepository = $productVariationRepository;
    }

    public function detail($slug): RedirectResponse|View
    {
        $resp = $this->productListingRepository->getBySlug($slug);

        if ($resp['code'] == 200) {
            $variation = $this->productVariationRepository->groupedVariation($resp['data']->id);

            return view('front.product.detail', [
                'prouct' => $resp['data'],
                'variation' => $variation
            ]);
        } else {
            return redirect()->route('front.error.404');
        }
    }
}
