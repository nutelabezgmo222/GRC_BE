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
        Schema::create('risks_periods', function (Blueprint $table) {
            $table->tinyIncrements('rsk_per_id');
            $table->string('rsk_per_title', 150);
            $table->string('rsk_per_probability_title', 150);
            $table->string('rsk_per_consequence_title', 150);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risks_periods');
    }
};
