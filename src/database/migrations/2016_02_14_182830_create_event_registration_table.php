<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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


            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')
                ->references('id')
                ->on('event')
                ->onDelete('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->onDelete('cascade');

            $table->tinyInteger('is_accepted')->default(0);
            $table->tinyInteger('is_confirmed')->default(0);
            $table->tinyInteger('is_attended')->default(0);
            $table->tinyInteger('is_cancelled')->default(0);


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
