<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name'=>'string',
            'name_qr'=>'string',
            'name_ru'=>'string',
            'title_img'=>'url',
            'first_price'=>'double',
            'discount'=>'nullable|',
            'second_price'=>'nullable|',
            'description'=>'string',
            'description_qr'=>'string',
            'description_ru'=>'string',
            'images_url'=>'url|string',
        ];
    }
}
