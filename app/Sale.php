<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
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
}
