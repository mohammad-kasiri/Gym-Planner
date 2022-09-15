<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::query()->create([
            'mobile'     => $request->validated('mobile'),
        ]);
        //Auth::login($user);
        $token = $user->createToken('authentication')->plainTextToken;

        return response([
            'user'  => Arr::except($user,['password','id', 'updated_at' , 'created_at']),
            'token' => $token
        ] , Response::HTTP_CREATED);
    }
}
