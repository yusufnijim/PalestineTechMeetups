<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(EventTableSeeder::class);
        $this->call(BlogTableSeeder::class);

//        Model::reguard();
    }
}
