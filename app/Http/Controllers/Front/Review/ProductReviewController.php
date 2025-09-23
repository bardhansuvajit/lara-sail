<?php

namespace App\Http\Controllers\Front\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\ProductListingInterface;
use App\Interfaces\ProductVariationInterface;

class ProductReviewController
{
    private ProductListingInterface $productListingRepository;
    private ProductVariationInterface $productVariationRepository;

    public function __construct(ProductListingInterface $productListingRepository, ProductVariationInterface $productVariationRepository)
    {
        $this->productListingRepository = $productListingRepository;
        $this->productVariationRepository = $productVariationRepository;
    }

    public function listByProduct($slug): RedirectResponse|View
    {
        $resp = $this->productListingRepository->getBySlug($slug);

        if ($resp['code'] == 200) {
            dd('here');
            $product = $resp['data'];
            // $pricingCountry = COUNTRY['country'];
            // $variation = $this->productVariationRepository->groupedVariation($product->id, $pricingCountry);

            // return view('front.product.detail', [
            //     'product' => $product,
            //     'status' => $product->statusDetail,
            //     'activeImagesCount' => count($product->activeImages),
            //     'variation' => $variation,
            //     'upsells' => [],
            //     'highlights' => $product->activeHighlights,
            //     'faqs' => $product->activeFaqs,
            //     'reviews' => $product->activeReviews,
            // ]);
        } else {
            return redirect()->route('front.error.404');
        }
    }
}
