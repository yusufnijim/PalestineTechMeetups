<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');
            

            $table->string('title');
            $table->longText('body');
            $table->tinyInteger('is_registration_open')->nullable();
            $table->integer('max_registrars_count')->nullable();

            $table->timestamp('published_at');
            $table->date('date');
            $table->string('location');


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
        Schema::drop('event');
    }
}
