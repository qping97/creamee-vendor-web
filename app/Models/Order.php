<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    public $guarded = [];

    protected $fillable = [
        'order_date',
        'pickup_date',
        'order_status',
        'shipping_address',
        'amount',
        'payment',
        'delivery_method',
        'delivery_fee',
        'order_notes',
        'customer_id',
        'vendor_id',
    ];

/*====================================
=            relationship            =
====================================*/
public function customer()
{
    return $this->belongsTo(Customer::class, 'customer_id');
}

public function product(){
    
    return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity');
}
}
