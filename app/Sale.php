<?php

namespace App;
use App\SaleDetail;
use App\Client;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    
    protected $fillable = [
        'folio',
        'saleDate',
        'payDate',
        'cancellationDate',
        'previousAmount',
        'tax',
        'amount',
        'saleStatus',
        'shippingStatus',
        'client_id'
    ];

    protected $hidden = ['client_id'];

    public function salesDetails(){
        return $this->hasMany(SaleDetail::class);
    }

    public function client(){
        return $this->hasOne(Client::classs);
    }
}
