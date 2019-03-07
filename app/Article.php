<?php

namespace App;
use App\Category;
use App\ArticleImage;
use App\SaleDetail;
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
        return $this->hasMany(ArticleImage::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function salesDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }


}
