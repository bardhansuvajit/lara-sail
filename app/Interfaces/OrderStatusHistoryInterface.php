<?php

namespace App\Interfaces;

interface OrderStatusHistoryInterface
{
    public function list(?string $keyword, array $filters = [], string $perPage, string $sortBy, string $sortOrder);
    public function store(array $array);
    public function getByOrderId(int $orderId);
    public function exists(array $conditions);
}
