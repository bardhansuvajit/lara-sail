<?php

namespace App\Interfaces;

interface DeveloperSettingInterface
{
    public function list(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder);
    public function store(array $array);
    public function getById(int $id);
    public function getByKey(String $key);
    public function update(array $array);
    public function export(?String $keyword, array $filters = [], String $perPage, String $sortBy, String $sortOrder, String $type);
}
