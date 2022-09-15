<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumber;
use App\Rules\Verification;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mobile'              => ['required' , new PhoneNumber() , 'unique:users,mobile' , 'bail'] ,
            'verification_code'   => ['required' , 'min:6', new Verification(), 'bail'] ,
        ];
    }
}
