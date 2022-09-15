<?php

namespace Database\Seeders;

use App\Models\Muscle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MuscleSeeder extends Seeder
{
    private $muscles= [
        'شکمی',
        'تمام بدن',
        'سرشانه',
    ];

    public function run()
    {
        foreach ($this->muscles as $muscle)
            Muscle::query()->create(['title' => $muscle]);
    }
}
