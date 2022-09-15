<?php

namespace App\Rules;

use App\Models\Verification;
use Illuminate\Contracts\Validation\Rule;

class AvoidRepetitive implements Rule
{
    public function passes($attribute, $value)
    {
        if (! request()->has('mobile')) return false;

        $validCodeExists = Verification::query()->
        where('mobile' , request('mobile'))->
        where('code_expire_at' , '>' , now())->exists();

        return  !$validCodeExists;
    }


    public function message()
    {
        return __('در حال حاضر یک کد حلوی کد تایید برای شما ارسال شده است٫');
    }
}
