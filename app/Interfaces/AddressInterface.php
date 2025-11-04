<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface AddressInterface
{
    public function list(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function store(array $array);
    public function getById(int $id);
    public function exists(array $conditions);
    public function update(array $array);
    public function delete(int $id);
    public function deleteLoggedInUserAddress(int $id, int $userId);
    public function updateDefaultAddress(int $id, int $userId);
    public function bulkAction(array $array);
    public function import(UploadedFile $file);
    public function export(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder, String $type);
    public function position(array $ids);
}
