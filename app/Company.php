<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'fiscalName',
        'rfc',
        'zipCode',
        'colony',
        'street',
        'noInt',
        'notExt',
        'phone',
        'mobile',
        'email'
    ];
}
