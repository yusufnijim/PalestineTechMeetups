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
            'first_name' => 'admin',
            'last_name'  => 'admin',
            'email'      => 'admin@admin.com',
            'password'   => bcrypt('admin'),
        ]);

        factory(App\Models\User\UserModel::class, 20)->create();
    }
}
