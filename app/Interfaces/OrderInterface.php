<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface OrderInterface
{
    public function list(?string $keyword, array $filters = [], string $perPage, string $sortBy, string $sortOrder);
    public function store(array $array);
    public function getById(int $id);
    public function exists(array $conditions);
    public function update(array $array);
    public function updateStatus(array $array);
    public function updateCartTotals($cart);
    public function updatePaymentMethod(int $id, int $cartId);
    public function delete(int $id);
    public function bulkAction(array $array);
    public function import(UploadedFile $file);
    public function export(?string $keyword, array $filters = [], string $perPage, string $sortBy, string $sortOrder, string $type);
}
