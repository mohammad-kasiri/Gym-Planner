<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Muscle;
use Illuminate\Http\Request;

class MuscleController extends Controller
{
    public function index()
    {
        $muscles= Muscle::query()->select(['id', 'title'])->get();
        return response()->json(['data' => $muscles]);
    }
}
