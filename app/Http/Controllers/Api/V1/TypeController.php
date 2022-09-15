<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types= Type::query()->select(['id', 'title'])->get();
        return response()->json(['data' => $types]);
    }
}
