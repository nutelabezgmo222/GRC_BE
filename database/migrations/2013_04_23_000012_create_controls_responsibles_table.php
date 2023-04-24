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
        Schema::create('controls_responsibles', function (Blueprint $table) {
            $table->BigInteger('cntrl_id')->unsigned();
            $table->BigInteger('u_id')->unsigned();
            $table->primary(['cntrl_id', 'u_id']);
        });

        Schema::table('controls_responsibles', function($table) {
            $table->foreign('cntrl_id')->references('id')->on('controls');
            $table->foreign('u_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('controls_responsibles');
    }
};
