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
        Schema::create('periods_consequence_cols', function (Blueprint $table) {
            $table->id('id');
            $table->string('per_cons_col_title', 100);
            $table->tinyInteger('per_cons_col_num');
            $table->BigInteger('per_cons_row_id')->unsigned();
        });

        Schema::table('periods_consequence_cols', function($table) {
            $table->foreign('per_cons_row_id')->references('id')->on('periods_consequence_rows')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periods_consequence_cols');
    }
};
