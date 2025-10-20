<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface CouponUsageInterface
{
    public function list(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function getUserCouponUsageCount(int $couponId, int $userId);
    public function store(Array $array);
}
