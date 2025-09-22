<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductFaq extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'product_variation_id',
        'user_id',
        'question',
        'answer',
        'helpful_score',
        'view_count',
        'helpful_yes',
        'helpful_no',
        'position',
        'status',
    ];

    protected $casts = [
        'helpful_score' => 'integer',
        'view_count' => 'integer',
        'helpful_yes' => 'integer',
        'helpful_no' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
