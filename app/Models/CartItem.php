<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cart_id','product_id','product_variation_id','product_title','variation_attributes',
        'sku','selling_price','mrp','quantity','total','is_available','availability_message',
        'options','custom_fields','status'
    ];

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart', 'cart_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

}
