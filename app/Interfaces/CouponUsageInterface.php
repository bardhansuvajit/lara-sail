<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface CouponUsageInterface
{
    public function list(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function getUserCouponUsageCount(int $couponId, int $userId);
    public function store(array $array);
}
