<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trash extends Model
{
    protected $fillable = [
        'model',
        'table_name',
        'deleted_row_id',
        'thumbnail',
        'title',
        'description',
        'status',
    ];
}
