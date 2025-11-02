<?php

namespace App\Interfaces;

interface OrderStatusInterface
{
    public function list(?string $keyword, array $filters = [], string $perPage, string $sortBy, string $sortOrder);
    public function exists(array $conditions);
}
