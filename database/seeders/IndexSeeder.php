<?php

namespace Database\Seeders;

use App\Models\Index;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndexSeeder extends Seeder
{
    private $indices= [
        [
            'title'  => 'وزن',
            'unit'   => 'kg',
        ],
        [
            'title'  => 'مسافت',
            'unit'   => 'm',
        ],
        [
            'title'  => 'Reps',
            'unit'   => null,
        ],
        [
            'title'  => 'زمان',
            'unit'   => 'min',
        ],
    ];
    public function run()
    {
        foreach ($this->indices as $index)
            Index::query()->create($index);
    }
}
