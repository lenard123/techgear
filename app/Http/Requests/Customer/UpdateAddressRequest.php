<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'region_id' => 'nullable|required_with:province_id|exists:regions',
            'province_id' => 'nullable|required_with:city_id|exists:provinces',
            'city_id' => 'nullable|required_with:barangay_id|exists:cities',
            'barangay_id' => 'nullable|exists:barangays,code',
            'street' => 'nullable',
            'unit' => 'nullable',
        ];
    }
}
