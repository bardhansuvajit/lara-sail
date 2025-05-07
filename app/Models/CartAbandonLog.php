<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartAbandonLog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cart_id','action','notes','status'
    ];
}
