<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddEmployeeRequest;

class EmployeeController extends Controller
{
    public function login(Request $request){
        $user = Employee::where('phone', $request->phone)->first();
        $password = $request->password;
        if(!$user OR !Hash::check($password,$user->password)){
            return ResponseController::error('Phone or Password incorrect',401);
        }
        $token = $user->createToken('employee')->plainTextToken;
        return ResponseController::data([
            'token' => $token
        ]);
    }

    public function add(AddEmployeeRequest $request){
        try{
            $this->authorize('create',Employee::class);
        }catch(\Throwable $th){
            return ResponseController::error('You are not allowed',403);
        }
        Employee::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'marketolog'
        ]);
        return ResponseController::success('Employee added',201);
    }
    public function delete(Employee $employee){
        try{
            $this->authorize('delete',Employee::class);
        }catch(\Throwable $th){
            return ResponseController::error('You are not allowed',403);
        }
        $employee->delete();
        return ResponseController::success('Marketolog deleted');
    }
    public function allusers(){
        try{
            $this->authorize('view',Employee::class);
        }catch(\Throwable $th){
            return ResponseController::error('You are not allowed',403);
        }
        $users = User::paginate(10);
        $collection = [
            "last_page" =>$users->lastPage(),
            "users" => []
        ];
        foreach ($users as $user){
            $collection['users'][] = new UserResource($user);
            
        }
        return ResponseController::data($collection);
    }

    public function employees(){
        $employees = Employee::where('role', 'marketolog')->get();
        return ResponseController::data($employees);
    }

    public function index(User $user){
        try{
            $this->authorize('view',Employee::class);
        }catch(\Throwable $th){
            return ResponseController::error('You are not allowed',403);
        }
        return response([
            'message' =>'User information',
            'data'=> new UserResource($user)
        ]);
    }
}
