<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\CategoryProductResource;
use App\Http\Resources\OneProductResource;
use App\Models\CategoryProduct;
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
        $categories = $request->category_id;    
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
        

        foreach($categories as $category){
            CategoryProduct::create([
                'category_id'=>$category,
                'product_id'=>$product->id,
            ]);
        }
        return ResponseController::success('Product succesfuly created',201);
    }

    public function update(ProductUpdateRequest $request,Product $product){
        try {
            $this->authorize('update',$product);
        } catch (\Throwable $th) {
             return ResponseController::error('You are not allowed to update',403);
        }
        $product->update($request->only([
            'name',
            'title_img',
            'first_price',
            'discount',
            'description',
            'images_url'
        ]));
        return ResponseController::success('Product succesfuly updated',200);
    }
    public function delete(Product $product){
        try {
            $this->authorize('delete',$product);
        } catch (\Throwable $th) {
             return ResponseController::error('You are not allowed to delete',403);
        }
        return $product->categories()->get( );
        $product->categoryProducts()->delete();
        $product->delete();
        return ResponseController::success('Product succesfuly deleted',200);
    }

    public function allproducts(){
        $products = Product::paginate(10);
        $collection = [
            "last_page" =>$products->lastPage(),
            "products" => []
        ];
        foreach($products as $product){
            $collection['products'][] = new CategoryProductResource($product);
        }
        return ResponseController::data($collection);
    }
    public function index(Product $product){
        return response([
            'message' => 'Product',
            'data'=> new OneProductResource($product)
        ]);
    }
}
