<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flavor extends Model
{
    use HasFactory;

    protected $table = 'flavor';

    protected $fillable = [
        'type',
        'price',
        'vendor_id'
    ];

    protected $casts = [
        'id' => 'integer',
    ];

/*====================================
=            relationship            =
====================================*/
public function vendorsflavor()
{
    return $this->belongsTo(Vendor::class, 'vendor_id');
}

public function customcake()
{
    return $this->hasMany(CustomCake::class, 'flavor_id');
}
}
