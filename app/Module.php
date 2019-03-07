<?php

namespace App;

use App\Role;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'genericCode',
        'module',
        'description',
        'url',
        'status'
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function privileges(){
        return $this->hasMany(Privilege::class);
    }
}
