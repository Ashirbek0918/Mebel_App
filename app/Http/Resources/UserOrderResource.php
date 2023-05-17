<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class UserOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'product_id'=>$this->product_id,
            'product_name'=>$this->product->name ?? Product::onlyTrashed()->where('id',$this->product_id)->first()->name,
            'status'=>$this->status,
            'seller_name'=>$this->product->seller->title ?? Product::onlyTrashed()->where('id',$this->product_id)->first()->seller->title,
            'updated_at'=>$this->updated_at
        ];
    }
}
