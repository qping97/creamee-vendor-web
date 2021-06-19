<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'name',
        'product_img',
        'product_price',
        'description',
        'product_category_id',
        'vendor_id',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    /*====================================
=            relationship            =
====================================*/
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function order(){
        return $this->belongsToMany(Order::class, 'order_product')->withPivot('quantity');
    }
    
}
