<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

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

    public function categories(){
         return $this->belongsToMany('App\Category', 'articles_categories', 'article_id', 'category_id');
    }

}
