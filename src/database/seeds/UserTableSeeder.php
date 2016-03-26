<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'first_name' => str_random(10),
            'last_name' => str_random(10),
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        DB::table('user')->insert([
            'first_name' => str_random(10),
            'last_name' => str_random(10),
            'email' => str_random(10) . '@gmail.com',
            'password' => bcrypt(str_random(10)),
        ]);
    }
}
