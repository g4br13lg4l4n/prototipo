<?php

namespace App;

use App\Module;
use Illuminate\Database\Eloquent\Model;

class Privileges extends Model
{
    protected $fillable = [
        'code',
        'privilege',
        'description',
        'status'
    ];

    public function module(){
        return $this->belongsTo(Module::class);
    }
}
