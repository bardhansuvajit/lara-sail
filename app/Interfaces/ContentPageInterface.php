<?php

namespace App\Interfaces;

interface ContentPageInterface
{
    public function list(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function store(array $array);
    public function getById(int $id);
    public function getBySlug(String $slug);
    public function update(array $array);
    public function delete(int $id);
    public function bulkAction(array $array);
    public function export(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder, String $type);
    public function position(array $ids);
}
