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
            $allBadges = [
                0 => [
                    // truck icon
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M280-160q-50 0-85-35t-35-85H60l18-80h113q17-19 40-29.5t49-10.5q26 0 49 10.5t40 29.5h167l84-360H182l4-17q6-28 27.5-45.5T264-800h456l-37 160h117l120 160-40 200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H400q0 50-35 85t-85 35Zm357-280h193l4-21-74-99h-95l-28 120Zm-19-273 2-7-84 360 2-7 34-146 46-200ZM20-427l20-80h220l-20 80H20Zm80-146 20-80h260l-20 80H100Zm180 333q17 0 28.5-11.5T320-280q0-17-11.5-28.5T280-320q-17 0-28.5 11.5T240-280q0 17 11.5 28.5T280-240Zm400 0q17 0 28.5-11.5T720-280q0-17-11.5-28.5T680-320q-17 0-28.5 11.5T640-280q0 17 11.5 28.5T680-240Z"/></svg>',
                    
                    'title' => 'Delivery',
                    'desc' => 'Standard delivery',
                ],
                1 => [
                    // rupee icon
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M549-120 280-400v-80h140q53 0 91.5-34.5T558-600H240v-80h306q-17-35-50.5-57.5T420-760H240v-80h480v80H590q14 17 25 37t17 43h88v80h-81q-8 85-70 142.5T420-400h-29l269 280H549Z"/></svg>',
                    'title' => 'Cash on Delivery',
                    'desc' => 'Available in many pin codes — select at checkout',
                ],
                2 => [
                    // return icon
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M440-122q-121-15-200.5-105.5T160-440q0-66 26-126.5T260-672l57 57q-38 34-57.5 79T240-440q0 88 56 155.5T440-202v80Zm80 0v-80q87-16 143.5-83T720-440q0-100-70-170t-170-70h-3l44 44-56 56-140-140 140-140 56 56-44 44h3q134 0 227 93t93 227q0 121-79.5 211.5T520-122Z"/></svg>',
                    
                    'title' => 'Easy Returns',
                    'desc' => '7-day hassle-free returns on eligible items',
                ],
                3 => [
                    // shield icon
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-113.23q-6 0-11.64-1-5.64-1-10.9-3-124.31-44.5-197.25-156.5t-72.94-242.5v-177.19q0-21.37 12.37-38.71t31.9-25.02L456-841.34q12.1-4.43 24-4.43t24.19 4.43l224.46 84.19q19.34 7.68 31.71 25.02 12.37 17.34 12.37 38.71v177.19q0 130.5-72.94 242.5t-197.06 156.5q-5.45 2-11.09 3t-11.64 1Z"/></svg>',
                    
                    'title' => 'Secure Payments',
                    'desc' => 'SSL encrypted • Trusted payment gateways',
                ],
            ];

            return view('front.product.detail', [
                'currencyIcon' => COUNTRY['icon'],
                'product' => $product,
                'status' => $product->statusDetail,
                'activeImagesCount' => count($product->activeImages),
                'images' => $product->activeImages,
                'variation' => $variation,
                'upsells' => [],
                'highlights' => $product->activeHighlights,
                'faqs' => $product->activeFaqs,
                'reviews' => ($reviews['code'] == 200) ? $reviews['data'] : [],
                'allReviews' => $product->activeReviews,
                'allBadges' => $allBadges,
            ]);
        } else {
            return redirect()->route('front.error.404');
        }

    }
}
