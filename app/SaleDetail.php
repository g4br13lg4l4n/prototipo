<?php

namespace App;

use App\Sale;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $table = 'sales_details';
    
    protected $fillable = [
        'quantity',
        'unitPrice',
        'amount',
    ];
    
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function article(){
        return $this->belongsTo('App\Article');
    }
}
