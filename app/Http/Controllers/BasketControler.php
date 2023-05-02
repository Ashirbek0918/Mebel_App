<?php

namespace App\Http\Controllers;

use App\Http\Requests\BasketCreateRequest;
use App\Http\Resources\CategoryProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserBasketResource;
use App\Models\Basket;

class BasketControler extends Controller
{
    public function create(BasketCreateRequest $request){
        $basket = Basket::where('user_id',Auth()->user()->id)->where('product_id', $request->product_id)->first();
        if($basket){
            return ResponseController::error('This product is already added to your favorites',409);
        }
        Basket::create([
            'user_id' => Auth()->user()->id,
            'product_id' => $request->product_id
        ]);
        return ResponseController::success('This product has been added to your favorites',201);
    }

    public function delete(Basket $basket){
        $basket->delete();
        return ResponseController::success('This product has been deleted',200);
    }
    public function baskets(){
        $baskets = Auth()->user()->basket;
        // return $baskets;
        if(count($baskets) == 0){
            return ResponseController::error('Basket is null');
        }
        $collection = [
            'message' => 'User favorite products',
            'products'=>[]
        ];
        foreach($baskets as $basket){
            $collection['products'][] = new CategoryProductResource($basket->product);
        }
        return ResponseController::data($collection);
    }
}
