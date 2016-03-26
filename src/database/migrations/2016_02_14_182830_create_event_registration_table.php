<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_registration', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('event_id');
            $table->integer('user_id');
            $table->tinyInteger('is_accepted')->nullable();
            $table->tinyInteger('is_confirmed')->nullable();
            $table->tinyInteger('is_attended')->nullable();


            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('event_registration');
    }
}
