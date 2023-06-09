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
        Schema::create('periods_probability_cols', function (Blueprint $table) {
            $table->id('id');
            $table->string('label', 100);
            $table->tinyInteger('col_num');
            $table->BigInteger('per_prob_row_id')->unsigned();
        });

        Schema::table('periods_probability_cols', function($table) {
            $table->foreign('per_prob_row_id')->references('id')->on('periods_probability_rows')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periods_probability_cols');
    }
};
