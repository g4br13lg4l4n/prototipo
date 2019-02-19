<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model
{
    protected $table = 'articles_images';
    protected $fillable = [
        'id', 
        'url'
    ];
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
