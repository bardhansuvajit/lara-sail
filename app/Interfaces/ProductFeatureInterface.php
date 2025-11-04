<?php

namespace App\Interfaces;
// use Illuminate\Http\UploadedFile;

interface ProductFeatureInterface
{
    public function list(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function listAllFeatured();
    public function listFeaturedOnly(string $type);
    public function getById(int $id);
    public function getByProductId(int $productId);
    public function store(array $array);
    public function update(int $id, array $array);
    public function delete(int $id);
    public function position(array $ids);
}
