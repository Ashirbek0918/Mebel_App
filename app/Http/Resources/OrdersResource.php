<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
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
            'product_name'=>$this->product->name,
            'user_id'=>$this->user_id,
            'user_name'=>$this->user->name,
            'status'=>$this->status,
            'seller_name'=>$this->product->seller->title,
            'seller_phone'=>$this->product->seller->admin->phone,
            'updated_at'=>$this->updated_at
        ];
    }
}
