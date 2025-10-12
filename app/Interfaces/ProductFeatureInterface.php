<?php

namespace App\Interfaces;
// use Illuminate\Http\UploadedFile;

interface ProductFeatureInterface
{
    public function list(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function listAllFeatured();
    public function listFeaturedOnly(string $type);
    public function getById(Int $id);
    public function getByProductId(Int $productId);
    public function store(Array $array);
    public function update(Int $id, Array $array);
    public function delete(Int $id);
    public function position(Array $ids);
}
