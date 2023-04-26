<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeAddRequest;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Requests\SellerCreateRequest;
use App\Http\Requests\SellerUpdateRequest;
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
            'seller_name'=>$request->seller_name,
            'seller_id'=>$sellerAdmin->id,
            'logo_img'=>$request->logo_img,
            'adress'=>$request->adress,
            'description'=>$request->description,
        ]);
        return ResponseController::success('Succesfully created',200);
    }
    public function update(SellerUpdateRequest $request, Seller $seller){
        try {
            $this->authorize('update',$seller);
        } catch (\Throwable $th) {
            return ResponseController::error('You are not allowed to update',403);
        }
        $seller->update($request->only([
            'seller_name',
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
        $seller->delete();
        return ResponseController::success('Succesfully deleted',200);
    }
}
