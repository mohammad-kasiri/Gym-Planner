<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Index;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index()
    {
        $indices= Index::query()->get();
        return view('admin.index.index')
            ->with(['indices' => $indices]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required'],
            'unit'  => ['nullable'],
        ]);

        Index::query()->create([
           'title' => $request->title,
           'unit'  => $request->get('unit' , null),
        ]);

        Session::flash('message', 'شاخص با موفقیت ویرایش شد.');
        return redirect()->back();
    }
}
