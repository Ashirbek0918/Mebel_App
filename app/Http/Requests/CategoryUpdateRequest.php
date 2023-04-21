<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'title_uz'=>['required', Rule::unique('categories')->ignore($this->category()->title_uz, 'title_uz')],
            'title_qr'=>['required', Rule::unique('categories')->ignore($this->category()->title_qr, 'title_qr')],
            'title_ru'=>['required', Rule::unique('categories')->ignore($this->category()->title_ru, 'title_ru')]
        ];
    }
}
