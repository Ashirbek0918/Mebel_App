<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryControler extends Controller
{
    public function create(Request $request){
        try{
            $this->authorize('create',Category::class);
        }catch(\Throwable $th){
            return ResponseController::error('You are not allowed',403);
        }
        $validation = Validator::make($request->all(),[
            'title'=>'required|string|unique:categories,title',
            'title_qr'=>'string|unique:categories,title_qr',
            'title_ru'=>'string|unique:categories,title_ru',
        ]);
        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(),422);
        }
        Category::create([
            'title'=>$request->title,
        ]);
        return ResponseController::success('Category created',201);
    }
    public function update(CategoryUpdateRequest $request, Category $category){
        try{
            $this->authorize('update',Category::class);
        }catch(\Throwable $th){
            return ResponseController::error('You are not allowed',403);
        }
        $category->update($request->only([
            'title'
        ]));
        return ResponseController::success('Category updated',200);
    }
    public function delete(Category $category){
        try{
            $this->authorize('delete',Category::class);
        }catch(\Throwable $th){
            return ResponseController::error('You are not allowed',403);
        }
        $category->delete();
        return ResponseController::success('Category deleted',200);
    }
}
