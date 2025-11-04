<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Collection;

interface CartInterface
{
    public function list(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function store(array $array);
    public function getById(int $id);
    public function exists(array $conditions);
    public function update(array $array);
    public function updateCartTotals($cart);
    public function updatePaymentMethod(int $id, int $cartId);
    public function updateShippingMethod(int $id, int $cartId);
    public function delete(int $id);
    public function bulkAction(array $array);
    public function import(UploadedFile $file);
    public function export(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder, String $type);
    public function position(array $ids);
    public function updateCartDiscount(array $cartData);
    // public function updateCartDiscount(?int $userId, ?string $deviceId, array $discountData);
    public function removeCouponById(int $cartId);
    // incase of multiple deviceIds of same user, clean cart
    public function cleanCart(string $deviceId, int $userId);
}
