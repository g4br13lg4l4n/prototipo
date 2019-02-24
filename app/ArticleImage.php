<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model
{
    protected $fillable = [
        'id', 
        'url'
    ];
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
