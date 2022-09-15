<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    private $plans= [
        [
            'parent_id'          =>  null,
            'title'              =>  'مقدماتی',
        ],
        [
            'parent_id'          =>  null,
            'title'              =>  'ویژه',
        ],
        [
            'parent_id'          =>   1,
            'title'              =>  'همیشگی',
            'days'               =>   0,
            'price'              =>   0,
        ],
        [
            'parent_id'          =>   2,
            'title'              =>  'یکماهه',
            'days'               =>   31,
            'price'              =>   30000,
        ],
        [
            'parent_id'          =>   2,
            'title'              =>  'سه ماهه',
            'days'               =>   92,
            'price'              =>   80000,
        ],
        [
            'parent_id'          =>   2,
            'title'              =>  'یکساله',
            'days'               =>   365,
            'price'              =>   300000,
        ],

    ];
    public function run()
    {
        foreach ($this->plans as $plan)
            Plan::query()->create($plan);
    }
}
