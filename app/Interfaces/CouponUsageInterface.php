<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface CouponUsageInterface
{
    public function list(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function getUserCouponUsageCount(int $couponId, int $userId);
    public function store(Array $array);
    public function getById(Int $id);
    public function getByIds(Array $ids);
    public function getBySlug(String $slug);
    public function getBySlugFDCustomArr(String $slug);
    public function update(Array $array);
    public function delete(Int $id);
    public function bulkAction(Array $array);
    public function import(UploadedFile $file);
    public function export(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder, String $type);
}
