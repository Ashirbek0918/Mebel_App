<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable = [
        'name',
        'phone',
        'password',
        'role'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
