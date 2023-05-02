<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|string',
            'name_qr'=>'string',
            'name_ru'=>'string',
            'title_img'=>'required|url',
            'first_price'=>'required|',
            'discount'=>'nullable|',
            'second_price'=>'nullable|',
            'seller_id'=>'required|exists:sellers,id',
            'description'=>'required|string',
            'description_qr'=>'string',
            'description_ru'=>'string',
            'images_url'=>'required',
            'category_id'=>'required|exists:categories,id'
        ];
    }
}
