<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface UserInterface
{
    public function list(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function store(array $array);
    public function getById(int $id);
    public function getByCountryPrimaryPhone(String $countryCode, String $phoneNo);
    public function loginCheck(String $countryCode, String $phoneNo, String $password);
    public function exists(array $conditions);
    public function update(array $array);
    public function delete(int $id);
    public function bulkAction(array $array);
    public function import(UploadedFile $file);
    public function export(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder, String $type);
}
