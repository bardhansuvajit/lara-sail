<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface TrashInterface
{
    public function list(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function store(Array $array);
    public function getById(Int $id);
    // public function update(Array $array);
    public function restore(Int $id);
    // public function bulkAction(Array $array);
    // public function import(UploadedFile $file);
    public function export(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder, String $type);
}
