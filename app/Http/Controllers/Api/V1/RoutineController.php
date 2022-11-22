<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Routine;
use App\Models\RoutineItem;
use App\Models\RoutineSet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RoutineController extends Controller
{
    public function index()
    {
        $routines= Routine::query()
            ->select(['id', 'title'])
            ->where('user_id', auth()->id())
            ->with('routineItems', function ($q) {    //With Items
                return $q->select(['id' , 'exercise_id', 'routine_id', 'note', 'order'])

                    ->with('exercise', function ($q) {              // With Exercise Of Each Item
                        return $q->select(['id' , 'type_id', 'fa_title', 'en_title', 'keywords'])->with('type' , function ($query){
                            return $query->select('id','title')->with('indices', function ($q){
                                return $q->select('id','title','unit')->get();
                            });
                        });
                    })

                    ->with('routineSets', function ($q) {           // With Routine Sets Of Each Item
                        return $q->select(['id' , 'routine_item_id', 'amount']);
                    });
            })->get();

        return response()->json(['data' => $routines], Response::HTTP_OK);
    }

    public function show($routine_id) {
        $routine= Routine::query()
            ->select(['id', 'title'])
            ->where('id', $routine_id)
            ->where('user_id', auth()->id())
            ->with('routineItems', function ($q) {    //With Items
                return $q->select(['id' , 'exercise_id', 'routine_id', 'note', 'order', 'rest_timer'])

                    ->with('exercise', function ($q) {              // With Exercise Of Each Item
                        return $q->select(['id' , 'type_id', 'fa_title', 'en_title', 'keywords']);
                    })

                    ->with('routineSets', function ($q) {           // With Routine Sets Of Each Item
                        return $q->select(['id' , 'routine_item_id', 'amount']);
                    });
            })->firstOrFail();

        return response()->json(['data' => $routine], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        DB::beginTransaction();
        try {
            $routine = Routine::query()->create([
                'user_id' => $user->id,
                'title' => $request->title
            ]);

            foreach ($request->exercises as $exercise) {
                $routineItem = RoutineItem::query()->create([
                    'routine_id'  => $routine->id,
                    'exercise_id' => $exercise['exercise_id'],
                    'note'        => $exercise['note'],
                    'order'       => $exercise['order'],
                    'rest_timer'  => $exercise['rest_timer'],
                ]);

                foreach ($exercise['sets'] as $set)
                    RoutineSet::query()->create([
                        'routine_item_id' => $routineItem->id,
                        'amount' => $set,
                    ]);
            }
            DB::commit();
        }catch(Exception $e) {
            DB::rollBack();
        }

        return response()->json([
            'message' => 'Routine Created Successfully'
        ], 201);
    }

    public function update($routine_id, Request $request)
    {
        $user = auth()->user();

        // =================DELETE ROUTINE ================= //
        $routine= Routine::query()
            ->select(['id', 'title'])
            ->where('id', $routine_id)
            ->where('user_id', $user->id)
            ->firstOrFail();
        DB::beginTransaction();
        try {
            $routine->forceDelete();
            DB::commit();
        }catch(Exception $e) {
            DB::rollBack();
        }

        // =================Create Routine Again ================= //
        DB::beginTransaction();
        try {
            $routine = new Routine;

            $routine->id = $routine_id ;
            $routine->user_id = $user->id;
            $routine->title = $request->title;
            $routine->save();

            foreach ($request->exercises as $exercise) {
                $routineItem = RoutineItem::query()->create([
                    'routine_id' => $routine->id,
                    'exercise_id' => $exercise['exercise_id'],
                    'note' => $exercise['note'],
                    'order' => $exercise['order'],
                    'rest_timer' => $exercise['rest_timer'],
                ]);

                foreach ($exercise['sets'] as $set)
                    RoutineSet::query()->create([
                        'routine_item_id' => $routineItem->id,
                        'amount' => $set,
                    ]);
            }
            DB::commit();
        }catch(Exception $e) {
            DB::rollBack();
        }

        return response()->json([
            'message' => 'Routine Updated Successfully'
        ], 201);
    }

    public function destroy($routine_id)
    {
        $user = auth()->user();

        $routine= Routine::query()
            ->select(['id', 'title'])
            ->where('id', $routine_id)
            ->where('user_id', $user->id)
            ->firstOrFail();



        DB::beginTransaction();
        try {
            $routine->delete();
            DB::commit();
        }catch(Exception $e) {
            DB::rollBack();
        }

        return response()->json([
            'message' => 'Routine Deleted Successfully'
        ], 202);
    }
}
