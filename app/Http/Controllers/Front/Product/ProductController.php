<?php

namespace App\Http\Controllers\Front\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\ProductListingInterface;
use App\Interfaces\ProductVariationInterface;
use App\Interfaces\ProductReviewInterface;

class ProductController extends Controller
{
    private ProductListingInterface $productListingRepository;
    private ProductVariationInterface $productVariationRepository;
    private ProductReviewInterface $productReviewRepository;

    public function __construct(
        ProductListingInterface $productListingRepository, 
        ProductVariationInterface $productVariationRepository,
        ProductReviewInterface $productReviewRepository
    )
    {
        $this->productListingRepository = $productListingRepository;
        $this->productVariationRepository = $productVariationRepository;
        $this->productReviewRepository = $productReviewRepository;
    }

    public function detail($slug): RedirectResponse|View
    {
        $topReviewsToShow = 3;
        $resp = $this->productListingRepository->getBySlugFDCustomArr($slug);

        if ($resp['code'] == 200) {
            $product = $resp['data'];
            $pricingCountry = COUNTRY['country'];
            $reviews = $this->productReviewRepository->activeFDReviewsByProductId($product->id, $topReviewsToShow);
            $variation = $this->productVariationRepository->groupedVariation($product->id, $pricingCountry);

            // dd($variation['data']['combinations']);

            return view('front.product.detail', [
                'currencyIcon' => COUNTRY['icon'],
                'product' => $product,
                'status' => $product->statusDetail,
                'activeImagesCount' => count($product->activeImages),
                'variation' => $variation,
                'upsells' => [],
                'highlights' => $product->activeHighlights,
                'faqs' => $product->activeFaqs,
                'reviews' => ($reviews['code'] == 200) ? $reviews['data'] : [],
                'allReviews' => $product->activeReviews,
            ]);
        } else {
            return redirect()->route('front.error.404');
        }

    }
}
