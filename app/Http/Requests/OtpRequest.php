<?php

namespace App\Http\Requests;

use App\Rules\AvoidRepetitive;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OtpRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mobile' => [
                'required',
                new PhoneNumber(),
                Rule::when(request()->has('for') && request('for') == 'register', 'unique:users,mobile'),
                Rule::when(request()->has('for') && request('for') == 'login', 'exists:users,mobile'),
                new AvoidRepetitive(),
                'bail'
            ],

            'for' => [
                'required',
                Rule::in(['register', 'login']),
                'bail'
            ]
        ];
    }
}
