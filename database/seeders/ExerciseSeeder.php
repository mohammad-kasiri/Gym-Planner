<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    private $exercises= [
            [
                'user_id' => 1,
                'type_id' => 1,
                'equipment_id' =>1,
                'primary_muscle_id' => 1,
                'other_muscles' => [2,3],

                'fa_title' => 'ایروبیک',
                'en_title' => 'Aerobics',
                'keywords' => 'ایروبیک − کاردیو - aerobics',
                'is_public' => true,
            ],
            [
                'user_id' => 1,
                'type_id' => 2,
                'equipment_id' =>2,
                'primary_muscle_id' => 2,
                'other_muscles' => [2,3],

                'fa_title' => 'بوکس',
                'en_title' => 'Boxing',
                'keywords' => 'ایروبیک − کاردیو - Boxing',
                'is_public' => true,
            ],
        ];
    public function run()
    {
        foreach ($this->exercises as $exercise)
            Exercise::query()->create($exercise);
    }
}
