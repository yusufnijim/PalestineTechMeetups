<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('survey', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->longText('description');
//            $table->tinyInteger('is_published')->nullable();

            $table->timestamps();
        });

        //
        Schema::create('survey_question', function (Blueprint $table) {
            $table->increments('id');

            $table->string('question');
            $table->string('type');

            $table->longText('choices');

            $table->integer('survey_id')->unsigned();
            $table->foreign('survey_id')
                ->references('id')
                ->on('survey')
                ->onDelete('cascade');


            $table->string('rule');


            $table->timestamps();
        });


        //
        Schema::create('survey_answer', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');

            $table->integer('exam_id')->unsigned();
            $table->foreign('exam_id')
                ->references('id')
                ->on('survey')
                ->onDelete('cascade');

            $table->integer('question_id')->unsigned();

            $table->foreign('question_id')
                ->references('id')
                ->on('survey_question')
                ->onDelete('cascade');


            $table->string('answer');

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
        Schema::drop('survey_answer');
        Schema::drop('survey_question');
        Schema::drop('survey');
    }
}
