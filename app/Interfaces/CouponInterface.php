<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface CouponInterface
{
    public function list(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function listCountryBasedFrontendCoupons(string $country);
    public function checkAndApplyToCart(string $couponCode, $cartData);
    public function couponDiscountApplicableToCart($cartData);
    public function incrementCouponUsage(int $couponId);
    public function store(Array $array);
    public function getById(Int $id);
    public function getBySlug(String $slug);
    public function update(Array $array);
    public function delete(Int $id);
    public function bulkAction(Array $array);
    public function import(UploadedFile $file);
    public function export(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder, String $type);
    public function position(Array $ids);
}
