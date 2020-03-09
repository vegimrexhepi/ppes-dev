<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // lecturer role
        DB::table('roles')->insert([
           ['name' => 'administrator'],
           ['name' => 'lecturer'],
           ['name' => 'student'],
        ]);
    }
}
