<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductReview extends Model
{
    use SoftDeletes;

    // automatically update the product ratings when a review is created/ updated or deleted
    protected static function booted()
    {
        static::saved(function ($review) {
            if ($review->product) {
                $review->product->updateRating();
            }
        });

        static::deleted(function ($review) {
            if ($review->product) {
                $review->product->updateRating();
            }
        });
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductReviewImage', 'review_id', 'id')->orderBy('position')->orderBy('id', 'desc');
    }

    public function activeImages()
    {
        return $this->hasMany('App\Models\ProductReviewImage', 'review_id', 'id')->where('status', 1)->orderBy('position')->orderBy('id', 'desc');
    }
}
