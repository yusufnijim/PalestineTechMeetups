<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('arabic_full_name')->nullable();

            $table->string('email')->unique();
            $table->string('password', 60)->nullable();
            $table->rememberToken()->nullable();

            $table->string('fb_token');
            $table->string('fb_id');
            $table->string('phone_number');
            $table->string('location');

            $table->tinyInteger('profession')->nullable();
            $table->string('profession_location');
            $table->string('bio')->nullable();

            $table->tinyInteger('gender')->nullable();
            $table->string('image');

            $table->nullableTimestamps();
        });

        DB::table('user')->insert([
            'first_name' => 'Amin',
            'last_name' => 'Mukh',
            'email' => 'mukh_amin@yahoo.com',
            'password' => bcrypt('amin123'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user');
    }
}
