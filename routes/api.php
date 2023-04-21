<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryControler;
use App\Http\Controllers\EmployeeController;
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
    });


    //product
    
});


