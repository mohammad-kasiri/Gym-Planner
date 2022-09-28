<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Muscle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MuscleController extends Controller
{
    public function index()
    {
        $muscles = Muscle::query()->get();
        return view('admin.muscle.index')->with(['muscles' => $muscles]);
    }
    public function store(Request $request)
    {
        $this->validate($request , [
            'title' => ['required' , 'max:25']
        ]);

        Muscle::query()->create([
            'title' => $request->title
        ]);

        Session::flash('message', 'عضله با موفقیت ایجاد شد.');
        return redirect()->route('admin.muscle.index');
    }
}
