<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Equipment;
use App\Models\Muscle;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         User::factory()->superAdmin()->create();
         User::factory(10)->create();
         $this->call(PlanSeeder::class);
         $this->call(TypeSeeder::class);
         $this->call(EquipmentSeeder::class);
         $this->call(MuscleSeeder::class);
         $this->call(ExerciseSeeder::class);
         $this->call(IndexSeeder::class);
         $this->call(IndexTypeSeeder::class);
         $this->call(RoutineSeeder::class);
    }
}
