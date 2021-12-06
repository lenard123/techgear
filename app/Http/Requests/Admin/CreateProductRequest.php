<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'max_order' => 'nullable|numeric|min:0',
            'image' => 'nullable|image',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric|min:0',
        ];
    }
}
