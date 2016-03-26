<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission')->insert([
            'name' => 'Edit events',
            'category' => 'Events',
        ]);


        DB::table('permission')->insert([
            'name' => 'Manage events',
            'category' => 'Events',
        ]);
        
    }
}
