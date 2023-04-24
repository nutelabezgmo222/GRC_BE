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
        Schema::create('risks_responsibles', function (Blueprint $table) {
            $table->BigInteger('rsk_id')->unsigned();
            $table->BigInteger('u_id')->unsigned();
            $table->primary(['rsk_id', 'u_id']);
        });

        Schema::table('risks_responsibles', function($table) {
            $table->foreign('rsk_id')->references('rsk_id')->on('risks');
            $table->foreign('u_id')->references('u_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risks_responsibles');
    }
};
