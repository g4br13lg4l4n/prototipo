<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $table = 'sales_details';
    
    protected $fillable = [
        'quantity',
        'amount'
    ];
}
