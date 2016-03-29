<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('blog', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');

            $table->string('permalink', 255)->unique();

            $table->longText('body');
            $table->tinyInteger('is_published')->nullable();

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
        Schema::drop('blog');
    }
}
