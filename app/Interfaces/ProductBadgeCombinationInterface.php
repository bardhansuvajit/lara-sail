<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface ProductBadgeCombinationInterface
{
    public function list(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function store(array $array);
    public function getById(int $id);
    public function conditions(array $array);
    public function syncProductBadges(int $productId, array $sentBadgeIds);
    public function update(array $array);
    public function delete(int $id);
    public function bulkAction(array $array);
    public function import(UploadedFile $file);
    public function export(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder, String $type);
    public function position(array $ids);
}
