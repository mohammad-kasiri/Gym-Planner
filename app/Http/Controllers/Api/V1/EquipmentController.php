<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments= Equipment::query()->select(['id', 'title'])->get();
        return response()->json(['data' => $equipments]);
    }
}
