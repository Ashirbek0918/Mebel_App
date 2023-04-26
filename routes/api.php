<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryControler;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('user/register',[AuthController::class,'register']);
Route::post('user/login',[AuthController::class,'login']);
Route::post('login',[EmployeeController::class,'login']);
Route::middleware('auth:sanctum')->group(function(){
    Route::put('user/update',[AuthController::class,'update']);
    Route::get('user/logout',[AuthController::class,'logOut']);
    Route::get('user/getme',[AuthController::class,'getme']);
    Route::get('user/logout',[AuthController::class,'logOut']);


    //Category
    Route::controller(CategoryControler::class)->group(function(){
        Route::post('category/create','create');
        Route::put('category/update/{category}','update');
        Route::delete('category/delete/{category}','delete');
    });
    //seller
    Route::controller(SellerController::class)->group(function(){
        Route::post('seller/create','create');
        Route::put('seller/update/{seller}','update');
        Route::delete('seller/delete/{seller}','delete');
    });

    //product
    Route::controller(ProductController::class)->group(function(){
        Route::post('product/create','create');
    });
});


