<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EntranceController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request , [
           'mobile' => ['required', new PhoneNumber()]
        ]);

        $existence= User::query()->where('mobile', $request->mobile)->exists();

        return $existence
            ? response()->json(['exists' => true,  'mobile' => $request->mobile], Response::HTTP_ACCEPTED)
            : response()->json(['exists' => false, 'mobile' => $request->mobile], Response::HTTP_NOT_FOUND);
    }
}
