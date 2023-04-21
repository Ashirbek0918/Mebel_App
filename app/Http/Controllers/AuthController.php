<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $user = User::where('phone', $request->phone)->first();
        $password = $request->password;
        if(!$user OR Hash::check($password,$user->password)){
            return ResponseController::error('Phone or Password incorrect',401);
        }
        $token = $user->createToken('user')->plainTextToken;
        return ResponseController::data([
            'token' => $token
        ]);
    }
    public function register(UserRegisterRequest $request){
        $phone = $request->phone;
        $user = User::where('phone',$phone)->first();
        if($user){
            return ResponseController::error('This phone number already taken',422);
        }
        User::create([
            'name'=>$request->name,
            'phone'=>$phone,
            'password'=>Hash::make($request->password)
        ]);
        return ResponseController::success('Successfully created',200);
    }
    public function update(UserUpdateRequest $request){
        $user = $request->user();
        $user->update($request->only([
            'name',
            'phone',
            'password'
        ]));
        return ResponseController::success('Successfully updated',200);
    }
    public function getme(Request $request){
        $user = auth()->user();
        return $user;
    }
    public function logOut(Request $request){
        $request->user()->currentAccessToken()->delete();
        return ResponseController::success('You have successfully logged out',200);
    }
}
