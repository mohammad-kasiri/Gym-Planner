<?php

namespace Database\Seeders;

use App\Models\Index;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndexSeeder extends Seeder
{
    private $indices= [
        [
            'title'  => 'kg',
        ],
        [
            'title' => 'm'
        ],
        [
            'title' => 'Reps'
        ],
        [
            'title' => 'min'
        ],
    ];
    public function run()
    {
        foreach ($this->indices as $index)
            Index::query()->create($index);
    }
}
