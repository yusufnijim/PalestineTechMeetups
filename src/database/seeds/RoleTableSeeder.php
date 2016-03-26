<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            'name' => 'administrator',
            'label' => 'Administrator',

        ]);

        DB::table('role')->insert([
            'name' => 'volunteer',
            'label' => 'Volunteer',
        ]);


    }
}
