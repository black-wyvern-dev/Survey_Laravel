<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteSomeFieldAnswer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->dropColumn('question_option_id');
            $table->dropColumn('answers_session_id');
            $table->dropColumn('free_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->integer('question_option_id')->after('survey_id');
            $table->integer('answers_session_id')->after('question_option_id');
            $table->integer('free_text')->after('answers_session_id');
        });
    }
}
