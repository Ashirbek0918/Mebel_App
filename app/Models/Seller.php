<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Seller extends Model
{
    use HasFactory,HasApiTokens;
    protected $guarded = ['id'];

    public function getAdmin(){
        return $this->hasMany(SallerAdmin::class);
    }
}
