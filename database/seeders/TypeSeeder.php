<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([[
            'id' => 1,
            'name' =>'EF'
           
        ],[
            'id' => 2,
            'name' =>'EF-OR'
           
        ],[
            'id' => 3,
            'name' =>'EF-BLOOD'
           
        ],[
            'id' => 4,
            'name' =>'EF-BLOOD-OR'
           
        ],[
            'id' => 5,
            'name' =>'EF-DEATH'
           
        ],[
            'id' => 6,
            'name' =>'EF-DEATH-OR'
           
        ],[
            'id' => 7,
            'name' =>'EF-DEATH-BLOOD'
           
        ],[
            'id' => 8,
            'name' =>'EF-DEATH-BLOOD-OR'
           
        ],[
            'id' => 9,
            'name' =>'BABY'
           
        ]]);
    }
}
