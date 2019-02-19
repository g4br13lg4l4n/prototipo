<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
  
    protected $fillable = [
        'name', 
        'lastName', 
        'email', 
        'password', 
        'status',
    ];

    public function sales(){
        return $this->hasMany('App\Sale');
    }
}
