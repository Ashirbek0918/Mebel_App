<?php

namespace App\Models;

use App\Models\Product;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function admin(){
        return $this->hasOne(Employee::class,'id','seller_id');
    }
}
