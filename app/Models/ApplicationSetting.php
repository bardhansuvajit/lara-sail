<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationSetting extends Model
{
    protected $fillable = [
        'category', 'key', 'value', 'description'
    ];

    public function countryDetails()
    {
        return $this->belongsTo('App\Models\Country', 'country', 'code');
    }
}
