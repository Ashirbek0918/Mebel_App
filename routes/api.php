<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasketControler;
use App\Http\Controllers\CategoryControler;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('user/register',[AuthController::class,'register']);
Route::post('user/login',[AuthController::class,'login']);
Route::post('login',[EmployeeController::class,'login']);
Route::get('categories',[CategoryControler::class,'allCategories']);
Route::get('category/{category}',[CategoryControler::class,'category']);
Route::get('sellers',[SellerController::class,'index']);
Route::get('seller/{seller}',[SellerController::class,'seller']);
Route::get('products',[ProductController::class,'allproducts']);
Route::get('product/{product}',[ProductController::class,'index']);
Route::middleware('auth:sanctum')->group(function(){
    Route::put('user/update',[AuthController::class,'update']);
    Route::get('logout',[AuthController::class,'logOut']);
    Route::get('getme',[AuthController::class,'getme']);


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
        Route::put('product/update/{product}','update');
        Route::delete('product/delete/{product}','delete');
    });

    //order
    Route::controller(OrderController::class)->group(function(){
        Route::post('order/create','create');
        Route::put('order/update/{order}','update');
        Route::delete('order/delete/{order}','delete');
        Route::get('user/orders','userorder');
        Route::get('orders','allorders');
        Route::get('order/history','history');
    });

    //basket
    Route::controller(BasketControler::class)->group(function(){
        Route::post('basket/create','create');
        Route::delete('basket/delete/{basket}','delete');
        Route::get('user/favourites','baskets');
    });

    //file 
    Route::controller(ImageController::class)->group(function(){
        Route::post('image/upload', 'upload');
        Route::delete('image/delete', 'deleteImage');
    });
});


