<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Facades\SMS;
use App\Http\Controllers\Controller;
use App\Http\Requests\OtpRequest;
use App\Models\Verification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OTPController extends Controller
{
    public function store(OtpRequest $request)
    {
        $code = Verification::makeCode();

        $verification= Verification::query()->create([
            'mobile'         => $request->mobile,
            'code'           => $code,
            'code_expire_at' => Carbon::now()->addMinutes(Verification::CODE_VALID_FOR),
        ]);

        $sms = SMS::tokens(["token" => $verification->code])->sendLookUp($verification->mobile);
        return response()->json(['data' => $sms], Response::HTTP_CREATED);
    }
}
