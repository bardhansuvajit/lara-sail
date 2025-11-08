<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SidebarConfiguration extends Model
{
    protected $fillable = [
        'company_category_key',
        'sidebar_items',
        'is_active'
    ];

    protected $casts = [
        'sidebar_items' => 'array',
        'is_active' => 'boolean'
    ];

    public static function getByCategory($categoryKey)
    {
        return static::where('company_category_key', $categoryKey)
                    ->where('is_active', true)
                    ->first();
    }
}
