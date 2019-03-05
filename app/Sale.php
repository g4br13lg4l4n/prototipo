<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    
    protected $fillable = [
        'id', 
        'folio',
        'saleDate',
        'payDate',
        'cancellationDate',
        'previousAmount',
        'tax',
        'amount',
        'saleStatus',
        'shippingStatus',
    ];


    public function salesDetails(){
        return $this->hasMany('App\SaleDetail');
    }

    public function client(){
        return $this->hasOne('App\Client');
    }
}
