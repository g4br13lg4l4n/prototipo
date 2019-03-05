<?php

namespace App;

use App\User;
use App\Module;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'role', 
        'description', 
        'status',
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function modules(){
        return $this->belongsToMany(Module::class);
    }

}
