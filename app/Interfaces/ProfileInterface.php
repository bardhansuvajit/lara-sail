<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface ProfileInterface
{
    public function getById(String $guard, Int $id);
    public function update(Array $array);
    public function updateOptional(Array $array);
}
