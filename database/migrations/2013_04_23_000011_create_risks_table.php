<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risks', function (Blueprint $table) {
            $table->id('id');
            $table->string('title', 150);
            $table->text('description');
            $table->text('status');
            $table->text('thr_comment');
            $table->text('thr_lvl_comment');
            $table->text('vul_comment');
            $table->dateTime('approve_date')->nullable();
            $table->dateTime('creation_date');
            $table->BigInteger('approved_by')->unsigned()->nullable();
            $table->BigInteger('thr_lvl_id')->unsigned()->nullable();
            $table->BigInteger('created_by')->unsigned();
            $table->tinyInteger('rsk_per_id')->unsigned();
        });

        Schema::table('risks', function($table) {
            $table->foreign('approved_by')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('rsk_per_id')->references('id')->on('risks_periods');
            $table->foreign('thr_lvl_id')->references('id')->on('risks_level_of_threats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risks');
    }
};
