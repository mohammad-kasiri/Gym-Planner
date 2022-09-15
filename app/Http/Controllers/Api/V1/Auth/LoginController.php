<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\PhoneNumber;
use App\Rules\Verification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function passLogin(Request $request)
    {
        $this->validate($request, [
           'mobile'   => ['required', new PhoneNumber(), 'exists:users,mobile'],
           'password' => ['required']
        ]);


        $user = User::query()
            ->select('id','name', 'mobile', 'password')
            ->where('mobile', $request->mobile)
            ->firstOrFail();


        if (!Hash::check($request->password , $user->password))
            return response(["message" => "This mobile or password is invalid"] , Response::HTTP_NOT_FOUND);


        $token = $user->createToken('authentication')->plainTextToken;

        return response([
            'user'  => Arr::except($user,['password','id']),
            'token' => $token
        ] , Response::HTTP_OK);

    }

    public function OTPLogin(Request $request)
    {
        $this->validate($request, [
            'mobile'              => ['required' , new PhoneNumber() , 'exists:users,mobile' , 'bail'] ,
            'verification_code'   => ['required' , 'min:6', new Verification(), 'bail'] ,
        ]);

        $user = User::query()->where('mobile' , $request->mobile)->firstOrFail();

        $token = $user->createToken('authentication')->plainTextToken;

        return response([
            'user'  => Arr::except($user,['password','id', 'level' , 'mobile_verified_at', 'updated_at' , 'created_at' , 'last_login']),
            'token' => $token
        ] , Response::HTTP_OK);

    }
}
