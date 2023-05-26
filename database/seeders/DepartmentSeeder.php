<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([[
            'id' => 1,
            'name' =>'HIM'
           
        ],[
            'id' => 2,
            'name' =>'Dental'
           
        ],[
            'id' => 3,
            'name' =>'DSU'
           
        ]]);
    }
}
