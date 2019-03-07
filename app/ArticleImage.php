<?php

namespace App;

use App\Article;
use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model
{
    protected $fillable = [
        'url'
    ];
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
