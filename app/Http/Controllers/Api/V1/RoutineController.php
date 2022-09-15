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
        return Routine::all();
        $routines= Routine::query()
            ->select(['id', 'title'])
            ->where('user_id', auth()->id())
            ->get();
        return response()->json($routines, Response::HTTP_OK);
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
                    'routine_id' => $routine->id,
                    'exercise_id' => $exercise['exercise_id'],
                    'user_id' => $user->id,
                    'note' => $exercise['note'],
                    'order' => $exercise['order'],
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
}
