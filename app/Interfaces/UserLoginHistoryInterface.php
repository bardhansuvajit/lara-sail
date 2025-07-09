<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface UserLoginHistoryInterface
{
    public function store(Array $array);
}
