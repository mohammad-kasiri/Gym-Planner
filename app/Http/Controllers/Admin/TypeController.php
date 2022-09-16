<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Index;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TypeController extends Controller
{
    public function index()
    {
        $types= Type::query()->get();
        return view('admin.type.index')
            ->with(['types' => $types]);
    }

    public function create()
    {
        $indices= Index::query()->get();
        return view('admin.type.create')
            ->with(['indices' => $indices]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'    => ['required'],
            'indices'  => ['required', 'array'],
        ]);

        $type= Type::query()->create([
            'title' => $request->title
        ]);

        $type->indices()->sync($request->indices);

        Session::flash('message', 'تایپ با موفقیت ایجاد شد.');
        return redirect()->route('admin.type.index');
    }

    public function edit(Type $type)
    {
        $indices= Index::query()->get();
        return view('admin.type.edit')
            ->with(['indices' => $indices])
            ->with(['type'    => $type]);
    }

    public function update(Type $type, Request $request)
    {
        $this->validate($request, [
            'title'    => ['required'],
            'indices'  => ['required', 'array'],
        ]);

        $type->update([
            'title' => $request->title
        ]);

        $type->indices()->sync($request->indices);

        Session::flash('message', 'تایپ با موفقیت ویرایش شد.');
        return redirect()->back();
    }
}
