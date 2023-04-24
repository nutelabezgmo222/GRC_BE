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
            $table->id('rsk_id');
            $table->string('rsk_title', 150);
            $table->text('rsk_description');
            $table->text('thr_comment');
            $table->text('rsk_thr_lvl_comment');
            $table->text('vul_comment');
            $table->dateTime('rsk_approve_date')->nullable();
            $table->dateTime('rsk_creation_date');
            $table->BigInteger('rsk_approved_by')->unsigned()->nullable();
            $table->BigInteger('rsk_thr_lvl_id')->unsigned()->nullable();
            $table->BigInteger('rsk_created_by')->unsigned();
            $table->tinyInteger('rsk_per_id')->unsigned();
        });

        Schema::table('risks', function($table) {
            $table->foreign('rsk_approved_by')->references('u_id')->on('users');
            $table->foreign('rsk_created_by')->references('u_id')->on('users');
            $table->foreign('rsk_per_id')->references('rsk_per_id')->on('risks_periods');
            $table->foreign('rsk_thr_lvl_id')->references('rsk_thr_lvl_id')->on('risks_level_of_threats');
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
