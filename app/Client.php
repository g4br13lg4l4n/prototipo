<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;

class Client extends Authenticatable
{
    use HasMultiAuthApiTokens, Notifiable;

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
