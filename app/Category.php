<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    
    protected $fillable = [
        'id',
        'genericCode',
        'category',
        'shortName',
        'description',
        'level'
    ];


    public function articles(){
        return $this->belongsToMany('App\Article', 'articles_categories', 'category_id', 'article_id');
   }
}
