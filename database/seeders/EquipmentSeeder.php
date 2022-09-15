<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    private $equipments= [
        'هالتر',
        'دمبل',
        'میل',
    ];

    public function run()
    {
        foreach ($this->equipments as $equipments)
            Equipment::query()->create(['title' => $equipments]);

    }
}
