<?php

namespace App\Interfaces;

interface ProductCategoryInterface
{
    public function list(?string $keyword, array $filters = [], int $perPage, string $sortBy, string $sortOrder);
    public function store(Array $array);
}
