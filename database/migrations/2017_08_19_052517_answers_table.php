<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
            $table->unsignedInteger('survey_id');
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('question_option_id');
            $table->unsignedInteger('answers_session_id');
            $table->text('free_text');
            $table->text('request_info');
            $table->timestamps();
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->dropForeign(['survey_id']);
            $table->dropForeign(['question_id']);
        });
        Schema::dropIfExists('answers');
    }
}
