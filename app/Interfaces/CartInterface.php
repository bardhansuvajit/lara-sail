<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Collection;

interface CartInterface
{
    public function list(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function store(Array $array);
    public function getById(Int $id);
    public function exists(Array $conditions);
    public function update(Array $array);
    public function updateCartTotals($cart);
    public function updatePaymentMethod(Int $id, Int $cartId);
    public function updateShippingMethod(Int $id, Int $cartId);
    public function delete(Int $id);
    public function bulkAction(Array $array);
    public function import(UploadedFile $file);
    public function export(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder, String $type);
    public function position(Array $ids);
    public function updateCartDiscount(?int $userId, ?string $deviceId, array $discountData);
}
