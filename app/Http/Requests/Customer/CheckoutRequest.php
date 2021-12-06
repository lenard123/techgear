<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'required',
            'street' => 'required',
            'barangay_id' => 'required',
            'city_id' => 'required',
            'province_id' => 'required',
            'region_id' => 'required',
            'unit' => 'required'
        ];
    }
}
