<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([[
            'id' => 1,
            'name' =>'Manager'
           
        ],[
            'id' => 2,
            'name' =>'Doctor'
           
        ],[
            'id' => 3,
            'name' =>'Head Doctor'
           
        ],[
            'id' => 4,
            'name' =>'Supervaisor'
           
        ],[
            'id' => 5,
            'name' =>'Coder'
           
        ],[
            'id' => 6,
            'name' =>'Irr'
           
        ],[
            'id' => 7,
            'name' =>'Cdi'
           
        ],[
            'id' => 8,
            'name' =>'Def'
           
        ]]);
    }
}
