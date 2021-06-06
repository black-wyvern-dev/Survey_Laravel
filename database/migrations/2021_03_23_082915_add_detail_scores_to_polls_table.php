<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailScoresToPollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('polls', function (Blueprint $table) {
            $table->double('score_emp',3,1)->after('score');
            $table->double('score_ser',3,1)->after('score_emp');
            $table->double('score_env',3,1)->after('score_ser');
            $table->double('score_non',3,1)->after('score_env');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('polls', function (Blueprint $table) {
            $table->dropColumn('score_emp');
            $table->dropColumn('score_ser');
            $table->dropColumn('score_env');
            $table->dropColumn('score_non');
        });
    }
}
