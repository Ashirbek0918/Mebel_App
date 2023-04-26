<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(ProductCreateRequest $request){
        try {
            $this->authorize('create',Product::class);
        } catch (\Throwable $th) {
             return ResponseController::error('You are not allowed to create',403);
        }
        $product = Product::create([
            'name'=>$request->name,
            'title_img'=>$request->title_img,
            'first_price'=>$request->first_price,
            'discount'=>$request->discount,
            'second_price'=>$request->first_price-($request->first_price*$request->discount)/100,
            'description'=>$request->description,
            'seller_id'=>$request->seller_id,
            'images_url'=>$request->images_url
        ]);
        return ResponseController::success('Product succesfuly created',200);
    }
}
