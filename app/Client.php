<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guard = 'clients';
    //
    protected $fillable = [
        'name', 
        'lastName', 
        'email', 
        'password', 
        'status',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
