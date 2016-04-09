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
        // survey table
        Schema::create('survey', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name'); // name of this survey
            $table->longText('description')->nullable(); // description
            $table->longText('raw_form')->nullable(); // description

            $table->nullableTimestamps();
        });

        // question types table
        Schema::create('survey_question_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->nullableTimestamps();
        });


        // questions table
        Schema::create('survey_question', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title'); // question title

            $table->integer('survey_id')->unsigned(); // which survey the question belongs to
            $table->foreign('survey_id')
                ->references('id')
                ->on('survey')
                ->onDelete('cascade');

            $table->integer('type_id')->unsigned(); // type of the question, text, paragraph, dropdown, select...etc
            $table->foreign('type_id')
                ->references('id')
                ->on('survey_question_type')
                ->onDelete('cascade');


            $table->longText('choice')->nullable(); // potential values this question has.
            $table->longText('default')->nullable(); // potential values this question has.

            $table->string('rule')->nullable();
            $table->string('other')->nullable();
//            $table->integer('order')->unsigned()->nullable(); // will hold the order of questions to be displayed in

            $table->nullableTimestamps();
        });

        // answers table
        Schema::create('survey_question_answer', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id'); // user who submitted this answer

            $table->integer('survey_id')->unsigned(); //survey this answer belongs to
            $table->foreign('survey_id')
                ->references('id')
                ->on('survey')
                ->onDelete('cascade');

            $table->integer('question_id')->unsigned(); // the question this answer belongs to
            $table->foreign('question_id')
                ->references('id')
                ->on('survey_question')
                ->onDelete('cascade');


            $table->string('answer'); // value submitted by the user

            $table->nullableTimestamps();
        });


        // default question types, supported already
        DB::table('survey_question_type')->insert(
            array(
                array('name' => 'Short answer'),
                array('name' => 'Paragraph'),
                array('name' => 'Multiple choice'),
                array('name' => 'Checkboxes'),
                array('name' => 'Dropdown'),
                array('name' => 'Linear scale'),
                array('name' => 'Multiple choice grid'),
                array('name' => 'Date'),
                array('name' => 'Time'),
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('survey_question_answer');
        Schema::drop('survey_question');

        Schema::drop('survey_question_type');
        Schema::drop('survey');
    }
}
