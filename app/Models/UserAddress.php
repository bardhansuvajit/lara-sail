<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use SoftDeletes;

    public function countryDetail()
    {
        return $this->belongsTo('App\Models\Country', 'country_code', 'code');
    }

    public function stateDetail()
    {
        return $this->belongsTo('App\Models\State', 'state', 'code');
    }
}
