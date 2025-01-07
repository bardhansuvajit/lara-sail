<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CsvTemplate extends Model
{
    protected $fillable = [
        'model',
        'file_path',
        'description',
    ];
}
