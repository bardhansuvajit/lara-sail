<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface CartItemInterface
{
    public function list(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function store(Array $array);
    public function getById(Int $id);
    public function exists(Array $conditions);
    public function update(Array $array);
    public function updateAvailability(Array $conditions);
    public function qtyUpdate(Array $array);
    public function delete(Int $id);
    public function saveForLater(Int $id);
    public function moveToCart(Int $id);
    public function bulkAction(Array $array);
    public function import(UploadedFile $file);
    public function export(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder, String $type);
    public function position(Array $ids);
}
