<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Size extends Model
{
    use HasFactory;

    protected $table = 'size';

    protected $fillable = [
        'title',
        'price',
        'vendor_id'
    ];

    protected $casts = [
        'id' => 'integer',
    ];

/*====================================
=            relationship            =
====================================*/
public function vendors()
{
    return $this->belongsTo(Vendor::class, 'vendor_id');
}
public function customcake()
{
    return $this->hasMany(CustomCake::class, 'size_id');
}
}
