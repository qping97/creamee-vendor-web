<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Vendor extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Notifiable;
    use Authenticatable;

    protected $guard = 'vendor';
        
    protected $table = 'vendor';

    protected $fillable = [
        'vendor_name',
        'fullname',
        'username',
        'contact_no',
        'vendor_address',
        'image',
        'registration_no',
        'longitude',
        'latitude',
        'email',
        'password',
        'latitude',
        'longitude',
        'profile_img'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

/*====================================
=            relationship            =
====================================*/
    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }

    public function productCategory()
    {
        return $this->hasMany(ProductCategory::class, 'ven_id');
    }

    public function sizes()
    {
        return $this->hasMany(Size::class, 'vendor_id');
    }

    public function flavors()
    {
        return $this->hasMany(Flavor::class, 'vendor_id');
    }

}
