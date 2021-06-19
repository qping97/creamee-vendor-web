<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Admin extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Notifiable;
    use Authenticatable;

    protected $guard = 'admin';

    protected $table = 'admin';

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
