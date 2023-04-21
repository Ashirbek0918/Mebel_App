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
            'title_uz'=>'required|string|unique:categories,title_uz',
            'title_qr'=>'required|string|unique:categories,title_qr',
            'title_ru'=>'required|string|unique:categories,title_ru',
        ]);
        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(),422);
        }
        Category::create([
            'title_uz'=>$request->title_uz,
            'title_qr'=>$request->title_qr,
            'title_ru'=>$request->title_ru
        ]);
        return ResponseController::success('Category created',201);
    }
    public function update(CategoryUpdateRequest $request, Category $category){
        $category->update($request->only([
            'title_uz',
            'title_qr',
            'title_ru'
        ]));
        return ResponseController::success('Category updated',200);
    }
}
