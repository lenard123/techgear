<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MatchOldPassword;
use App\Rules\IsValidPasswordRule;

class UpdatePasswordRequest extends FormRequest
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
            'current_password' => [
                'required',
                new MatchOldPassword
            ],
            'password' => [
                'required',
                new IsValidPasswordRule
            ],
            'confirm_password' => 'required|same:password'
        ];
    }
}
