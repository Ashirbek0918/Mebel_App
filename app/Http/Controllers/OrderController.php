<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OrderGetRequest;
use App\Http\Resources\OrdersResource;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\OrderCreateRequest;
use App\Http\Resources\UserOrderResource;

class OrderController extends Controller
{
    public function create(OrderCreateRequest $request){
        $product = Product::where('id', $request->product_id)->first();
        if(!$product){
            return ResponseController::error('This product does not exist');
        }
        Order::create([
            'user_id' => Auth::user()->id,
            'product_id' =>$request->product_id,
            'status'=>"new",
        ]);
        return ResponseController::success('Successfully created',201);
    }

    public function delete(Order $order){
        try{
            $this->authorize('delete',$order);
        }catch(\Throwable $th){
            return ResponseController::error('You are not allowed',403);
        }
        $order->delete();
        return ResponseController::success('Successfully deleted');
    }
    public function allorders(OrderGetRequest $request){
        try{
            $this->authorize('viewAny',Order::class);
        }catch(\Throwable $th){
            return ResponseController::error('You are not allowed',403);
        }
        $orders = Order::where('status',$request->status)->paginate(20);
        $collection = [];
        if(count($orders) == 0){
            return ResponseController::error('Orders not yet',404);
        }
        $collection = [
            "last_page" =>$orders->lastPage(),
            "orders" => []
        ];
        foreach ($orders as $order){
            $collection['orders'][] = new OrdersResource($order);
        }
        return ResponseController::data($collection);
    }
     
    public function update(OrderRequest $request,Order $order){
        try{
            $this->authorize('update',Order::class);
        }catch(\Throwable $th){
            return ResponseController::error('You are not allowed',403);
        }
        $order->update($request->only([
            'status'
        ]));
        return ResponseController::success('Successfully updated');
    }
    public function userorder(){
        $orders = Auth::user()->order;
        $collection = [];
        foreach ($orders as $order){
            $collection['orders'][] = new UserOrderResource($order);
        }
        return response([
            'message'=>'User orders',
            'data'=>$collection
        ]);
    }

    public function history(){
        try{
            $this->authorize('viewAny',Order::class);
        }catch(\Throwable $th){
            return ResponseController::error('You are not allowed',403);
        }
        $orders = Order::onlyTrashed()->paginate(20);
        $collection = [
            "last_page" =>$orders->lastPage(),
            "orders" => []
        ];
        foreach ($orders as $order){
            $collection['orders'][] = new OrdersResource($order);
        }
        return ResponseController::data($collection);
        


    }
}
