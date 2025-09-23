<?php

namespace App\Http\Controllers\Front\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\ProductListingInterface;
use App\Interfaces\ProductVariationInterface;
use App\Interfaces\ProductReviewInterface;

class ProductReviewController extends Controller
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

    public function listByProduct($slug): RedirectResponse|View
    {
        $resp = $this->productListingRepository->getBySlugFDCustomArr($slug);

        if ($resp['code'] == 200) {
            $product = $resp['data'];
            // $pricingCountry = COUNTRY['country'];
            // $variation = $this->productVariationRepository->groupedVariation($product->id, $pricingCountry);
            $reviews = $this->productReviewRepository->allActivePaginatedReviewsByProductId($product->id);

            return view('front.review.index', [
                'product' => $product,
                // 'variation' => $variation,
                'reviews' => ($reviews['code'] == 200) ? $reviews['data'] : [],
                'allReviews' => $product->activeReviews,
            ]);
        } else {
            return redirect()->route('front.error.404');
        }

        /*
        $resp = $this->productListingRepository->getBySlug($slug);

        if ($resp['code'] == 200) {
            $variation = $this->productVariationRepository->groupedVariation($resp['data']->id);

            return view('front.product.detail', [
                'product' => $resp['data'],
                'variation' => $variation
            ]);
        } else {
            return redirect()->route('front.error.404');
        }
        */
    }
}
