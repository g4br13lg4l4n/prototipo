<?php

namespace App;
use App\Article;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id',
        'genericCode',
        'category',
        'shortName',
        'description',
        'level'
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
