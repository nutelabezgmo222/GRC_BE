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
        Schema::create('controls', function (Blueprint $table) {
            $table->id('id');
            $table->string('title', 150);
            $table->dateTime('deadline');
            $table->text('description');
            $table->text('expected_evidence');
            $table->BigInteger('created_by')->unsigned();
            $table->dateTime('creation_date');
        });

        Schema::table('controls', function($table) {
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('controls');
    }
};
