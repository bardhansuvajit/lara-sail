<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface CouponInterface
{
    public function list(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function listCountryBasedFrontendCoupons(string $country);
    public function checkAndApplyToCart(string $couponCode, $cartData);
    public function couponDiscountApplicableToCart($cartData);
}
