<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'internalCode', 
        'name',
        'shortName', 
        'description',
        'stock',
        'purchasePrice',
        'salePrice',
        'offerPrice',
        'status'
    ];


    public function images()
    {
        return $this->hasMany('App\ArticleImage');
    }
}
