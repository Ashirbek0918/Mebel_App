<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerCreateRequest extends FormRequest
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
            'seller_name'=>'required|string',
            'logo_img'=>'required|string',
            'adress'=>'required|string',
            'adress_qr'=>'string',
            'adress_ru'=>'string',
            'description'=>'required|string',
            'description_qr'=>'string',
            'description_ru'=>'string'
        ];
    }
}
