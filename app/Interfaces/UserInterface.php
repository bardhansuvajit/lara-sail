<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface UserInterface
{
    public function list(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function store(Array $array);
    public function getById(Int $id);
    public function getByCountryPrimaryPhone(String $countryCode, String $phoneNo);
    public function loginCheck(String $countryCode, String $phoneNo, String $password);
    public function exists(Array $conditions);
    public function update(Array $array);
    public function delete(Int $id);
    public function bulkAction(Array $array);
    public function import(UploadedFile $file);
    public function export(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder, String $type);
}
