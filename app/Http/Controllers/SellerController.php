<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeAddRequest;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Requests\SellerCreateRequest;
use App\Http\Requests\SellerUpdateRequest;
use App\Http\Resources\OneSellerResource;
use App\Http\Resources\SellerProductResource;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function create(SellerCreateRequest $request, EmployeeAddRequest $sellerrequest){
        try {
            $this->authorize('create',Seller::class);
        } catch (\Throwable $th) {
            return ResponseController::error('You are not allowed to create',403);
        }
        $sellerAdmin = Employee::create([
            'name'=>$sellerrequest->name,
            'phone'=>$sellerrequest->phone,
            'password'=>Hash::make($sellerrequest->password),
            'role'=>'seller'
        ]);
        $seller = Seller::create([
            'title'=>$request->title,
            'seller_id'=>$sellerAdmin->id,
            'logo_img'=>$request->logo_img,
            'adress'=>$request->adress,
            'description'=>$request->description,
        ]);
        return ResponseController::success('Succesfully created',201);
    }
    public function update(SellerUpdateRequest $request, Seller $seller){
        try {
            $this->authorize('update',$seller);
        } catch (\Throwable $th) {
            return ResponseController::error('You are not allowed to update',403);
        }
        $seller->update($request->only([
            'title',
            'logo_img',
            'adress',
            'description',
        ]));
        return ResponseController::success('Succesfully updated',200);
    }
    public function delete(Seller $seller){
        try {
            $this->authorize('delete',$seller);
        } catch (\Throwable $th) {
            return ResponseController::error('You are not allowed to delete',403);
        }
        $seller->products()->delete();
        Employee::where('id',$seller->seller_id)->delete();
        $seller->delete();
        return ResponseController::success('Succesfully deleted',200);
    }

    public function index(){
        $sellers = Seller::paginate(20);
        $collection = [
            "last_page" =>$sellers->lastPage(),
            "sellers" => []
        ];
        foreach($sellers as $seller){
            $collection["sellers"][] = new OneSellerResource($seller);
        }
        return ResponseController::data($collection);
        return response([
            'message'=>'Seller',
            'data'=> new OneSellerResource($seller)
        ]);
    }
    public function seller(Seller $seller){
        return response([
            'message'=>'Seller Products',
            'data'=>new SellerProductResource($seller)
        ]);
    }
}
