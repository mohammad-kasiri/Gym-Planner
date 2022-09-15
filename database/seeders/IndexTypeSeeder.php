<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndexTypeSeeder extends Seeder
{

    private $items= [
        [
            'type_id'  => 1,
            'index_id' => 1,
        ],
        [
            'type_id'  => 1,
            'index_id' => 2,
        ],
        [
            'index_id' => 2,
            'type_id'  => 2,
        ],
        [
            'index_id' => 3,
            'type_id'  => 4,
        ],
        [
            'index_id' => 4,
            'type_id'  => 1,
        ],
        [
            'index_id' => 4,
            'type_id'  => 4,
        ]
    ];
    public function run()
    {
        foreach ($this->items as $item)
            DB::table('index_type')->insert($item);
    }
}
