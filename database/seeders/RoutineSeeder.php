<?php

namespace Database\Seeders;

use App\Models\Routine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoutineSeeder extends Seeder
{
    private $items=
        [
            [
                'user_id' => 1,
                'title'   => 'first routine',
            ],
            [
                'user_id' => 1,
                'title'   => 'second routine',
            ],
            [
                'user_id' => 1,
                'title'   => 'third routine',
            ]
        ];
    public function run()
    {
        foreach ($this->items as $item)
            Routine::query()->create($item);
    }
}
