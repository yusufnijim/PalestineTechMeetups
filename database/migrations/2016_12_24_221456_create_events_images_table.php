<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_images', function (Blueprint $table) {
            $table->increments('id');

            $table->string('image');
            
            $table->integer('blog_id')->unsigned();
            $table->foreign('blog_id')
                ->references('id')
                ->on('blog')
                ->onDelete('cascade');

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
        Schema::drop('events_images');
    }
}
