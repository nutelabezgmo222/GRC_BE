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
            $table->string('cntrl_title', 150);
            $table->dateTime('cntrl_deadline');
            $table->text('cntrl_description');
            $table->text('cntrl_expected_evidence');
            $table->BigInteger('cntrl_created_by')->unsigned();
            $table->dateTime('cntrl_creation_date');
        });

        Schema::table('controls', function($table) {
            $table->foreign('cntrl_created_by')->references('id')->on('users');
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
