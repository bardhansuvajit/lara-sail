<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    protected $fillable = [
        'country_code', 'code', 'name', 'settings', 'svg_icon', 'status', 'position'
    ];
}
