<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template', function (Blueprint $table) {
            $table->dropColumn('header_left_template_id');
            $table->dropColumn('header_left_template_content');
            $table->dropColumn('header_center_template_id');
            $table->dropColumn('header_center_template_content');
            $table->dropColumn('header_right_template_id');
            $table->dropColumn('header_right_template_content');
            $table->string('name')->after('id');
            $table->string('description')->after('name');
            $table->string('header_left')->after('description')->nullable();
            $table->string('header_center')->after('header_left')->nullable();
            $table->string('header_right')->after('header_center')->nullable();
            $table->string('footer_left')->after('header_right')->nullable();
            $table->string('footer_center')->after('footer_left')->nullable();
            $table->string('footer_right')->after('footer_center')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('description');
            $table->dropColumn('header_left');
            $table->dropColumn('header_center');
            $table->dropColumn('header_right');
            $table->dropColumn('footer_left');
            $table->dropColumn('footer_center');
            $table->dropColumn('footer_right');
            $table->integer('header_left_template_id');
            $table->string('header_left_template_content');
            $table->integer('header_center_template_id');
            $table->string('header_center_template_content');
            $table->integer('header_right_template_id');
            $table->string('header_right_template_content');
        });
    }
}
