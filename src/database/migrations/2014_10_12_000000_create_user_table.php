<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
