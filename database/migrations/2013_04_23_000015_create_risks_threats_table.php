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
        Schema::create('risks_threats', function (Blueprint $table) {
            $table->BigInteger('rsk_id')->unsigned();
            $table->BigInteger('thr_id')->unsigned();

            $table->primary(['rsk_id', 'thr_id']);
        });

        Schema::table('risks_threats', function($table) {
            $table->foreign('rsk_id')->references('id')->on('risks');
            $table->foreign('thr_id')->references('id')->on('threats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risks_threats');
    }
};
