<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryProductResource extends JsonResource
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
            'name'=>$this->name,
            'title_img'=>$this->title_img,
            'first_price'=>$this->first_price,
            'discount'=>$this->discount,
            'second_price'=>$this->second_price,
            'seller'=>$this->seller->title,
        ];
    }
}
