<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('arabic_full_name')->nullable();

            $table->string('email')->unique()->nullable();
            $table->string('password', 60)->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();

            $table->string('fb_token')->nullable();
            $table->string('fb_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('location')->nullable();

            $table->tinyInteger('profession')->nullable();
            $table->string('profession_location')->nullable();

            $table->tinyInteger('gender')->nullable();
            $table->string('image')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
