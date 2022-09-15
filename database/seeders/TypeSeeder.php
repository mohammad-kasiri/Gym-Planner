<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    private $types= [
      'وزنی - مسافتی',
      'مسافتی',
      'زمانی',
      'زمانی - وزنی',
    ];

    public function run()
    {
        foreach ($this->types as $type)
            Type::query()->create(['title' => $type]);

    }
}
