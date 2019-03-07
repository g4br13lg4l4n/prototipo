<?php

namespace App;

use App\Sale;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 
        'lastName', 
        'email', 
        'password', 
        'status',
    ];

    public function sales(){
        return $this->hasMany(Sale::class);
    }
}
