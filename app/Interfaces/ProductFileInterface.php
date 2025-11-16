<?php

namespace App\Interfaces;

interface ProductFileInterface
{
    public function getById(int $id);
    public function delete(int $id);
}
