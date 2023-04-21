<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function login(Request $request){
        $user = Employee::where('phone', $request->phone)->first();
        $password = $request->password;
        // return $password;
        if(!$user OR !Hash::check($password,$user->password)){
            return ResponseController::error('Phone or Password incorrect',401);
        }
        $token = $user->createToken('employee')->plainTextToken;
        return ResponseController::data([
            'token' => $token
        ]);
    }
}
