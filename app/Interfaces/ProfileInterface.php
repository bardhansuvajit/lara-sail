<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface ProfileInterface
{
    public function getById(String $guard, int $id);
    public function update(array $array);
    public function updateOptional(array $array);
}
