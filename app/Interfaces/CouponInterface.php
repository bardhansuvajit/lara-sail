<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface CouponInterface
{
    public function list(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function listCountryBasedFrontendCoupons(string $country);
    public function checkAndApplyToCart(string $couponCode, $cart);
    // public function checkAndApplyToCart($cart);
    // public function checkAndApplyToCart(string $couponCode, ?int $userId, string $deviceId);
}
