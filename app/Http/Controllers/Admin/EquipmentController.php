<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Muscle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::query()->get();
        return view('admin.equipment.index')->with(['equipments' => $equipments]);
    }
    public function store(Request $request)
    {
        $this->validate($request , [
            'title' => ['required' , 'max:25']
        ]);

        Equipment::query()->create([
            'title' => $request->title
        ]);

        Session::flash('message', 'تجهیزات با موفقیت ایجاد شد.');
        return redirect()->route('admin.equipment.index');
    }
}
