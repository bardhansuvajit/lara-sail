<?php

namespace App\Interfaces;

interface ContentPageInterface
{
    public function list(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function store(Array $array);
    public function getById(Int $id);
    public function getBySlug(String $slug);
    public function update(Array $array);
    public function delete(Int $id);
    public function bulkAction(Array $array);
    public function export(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder, String $type);
    public function position(Array $ids);
}
