<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductEdTech extends Model
{
    protected $fillable = ['product_id', 'board_id', 'class_id', 'subject_id', 'school_id'];
}
