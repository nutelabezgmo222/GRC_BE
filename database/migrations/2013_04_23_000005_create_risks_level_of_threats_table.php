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
        Schema::create('risks_level_of_threats', function (Blueprint $table) {
            $table->id('id');
            $table->tinyInteger('rsk_per_id')->unsigned();
            $table->string('rsk_thr_lvl_option', 100);
        });

        Schema::table('risks_level_of_threats', function($table) {
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
        Schema::dropIfExists('risks_level_of_threats');
    }
};
