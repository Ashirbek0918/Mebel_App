<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'images_url' =>"json"
    ];

    public function categories(){
        return $this->belongsToMany(Category::class,'category_products');
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }
    public function basket(){
        return $this->hasMany(Basket::class);
    }
    public function categoryProducts(){
        return $this->hasMany(CategoryProduct::class);
    }
}
