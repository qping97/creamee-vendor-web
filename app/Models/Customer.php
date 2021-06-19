<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guard = 'customer';

    protected $table = 'customer';

    protected $fillable = [
        'name',
        'contact_no',
        'address',
        'email',
        'password',
        'longitude',
        'latitude',
        'profile_pic',
        'isblock'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
{
    return $this->hasMany(Order::class, 'customer_id');
}
public function customcake()
{
    return $this->hasMany(CustomCake::class, 'customer_id');
}
}
