<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdSection extends Model
{
    protected $fillable = [
        'page',
        'position',
        'name',
        'slug',
        'type',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(AdItem::class);
    }

    public function activeItemOnly()
    {
        return $this->hasOne(AdItem::class)->where('status', 1)->orderBy('position');
    }
}
