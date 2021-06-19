<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomCake extends Model
{
    use HasFactory;
    protected $table = 'custom_cake';

    protected $fillable = [
        'shape',
        'description',
        'customize_text',
        'image',
        'flavor_id',
        'size_id',
        'vendor_id',
        'customer_id'
    ];

    public function customers()
{
    return $this->belongsTo(Customer::class, 'customer_id');
}

public function sizes()
{
    return $this->belongsTo(Size::class, 'size_id');
}

public function flavors()
{
    return $this->belongsTo(Flavor::class, 'flavor_id');
}

}
