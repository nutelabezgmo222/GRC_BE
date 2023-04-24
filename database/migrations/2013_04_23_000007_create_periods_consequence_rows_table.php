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
        Schema::create('periods_consequence_rows', function (Blueprint $table) {
            $table->id('id');
            $table->string('per_cons_row_title', 100);
            $table->tinyInteger('rsk_per_id')->unsigned();
        });

        Schema::table('periods_consequence_rows', function($table) {
            $table->foreign('rsk_per_id')->references('id')->on('risks_periods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periods_consequence_rows');
    }
};
