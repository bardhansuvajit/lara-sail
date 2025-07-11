<?php

namespace App\Interfaces;
use Illuminate\Http\UploadedFile;

interface UserLoginHistoryInterface
{
    public function exists(Array $conditions);
    public function store(Array $array);
    public function validateToken(String $token, Int $userId);
    public function getById(Int $id);
    public function update(Array $array);
}
