<?php

namespace App\Interfaces;

interface ProductCategoryInterface
{
    public function list(?string $keyword, array $filters = [], int $perPage, string $sortBy, string $sortOrder);
    public function store(Array $array);
    public function getById(Int $id);
    public function update(Array $array);
    public function delete(Int $id);
    public function bulkAction(Array $array);
}
