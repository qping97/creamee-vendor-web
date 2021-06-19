<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'quantity',
        'price',
        'vendor_id',
        'customer_id',
        'order_id',
        'product_id'
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    /*====================================
=            relationship            =
====================================*/

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
