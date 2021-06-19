<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_category';
    protected $guarded = array();

    protected $fillable = [
        'name',
        'image',
        'ven_id',
    ];

    protected $casts = [
        'id' => 'integer',
    ];


/*====================================
=            relationship            =
====================================*/
public function products()
{
    return $this->hasMany(Product::class, 'product_category_id');
}

public function vendors()
{
    return $this->belongsTo(Vendor::class, 'ven_id');
}

}

