<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::query()
            ->select(['id', 'fa_title', 'en_title', 'keywords', 'type_id', 'equipment_id', 'primary_muscle_id', 'other_muscles'])
            ->public()
            ->orWhere('user_id' , auth()->id())
            ->with('type' , function ($query){
                return $query->select('id','title')->with('indices', function ($q){
                    return $q->select('id','title','unit')->get();
                });
            })
            ->with('equipment:id,title')
            ->with('primary_muscle:id,title')
            ->with('media')
            ->get();
        return response()->json(['data' => $exercises], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fa_title'              => ['required', 'string' , 'max:35'],
            'en_title'              => ['required', 'string' , 'max:35'],
            'type_id'               => ['required', 'exists:types,id'],
            'equipment_id'          => ['required', 'exists:equipment,id'],
            'primary_muscle_id'     => ['required', 'exists:muscles,id'],
            'other_muscles'         => ['array'],

            'image'                 => ['nullable', 'image', 'max:2048']
        ]);


        $exercise= auth()->user()->exercises()->create([
           'fa_title'            =>  $request->fa_title,
           'en_title'            =>  $request->en_title,
           'type_id'             =>  $request->type_id,
           'equipment_id'        =>  $request->equipment_id,
           'primary_muscle_id'   =>  $request->primary_muscle_id,
           'other_muscles'       =>  $request->other_muscles,
        ]);

        $exercise->setImage();

        return response()->json([
            'message' => 'exercise created successfully !'
        ], Response::HTTP_CREATED);

    }
}
