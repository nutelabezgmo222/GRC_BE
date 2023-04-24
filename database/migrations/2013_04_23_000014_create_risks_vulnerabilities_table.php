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
        Schema::create('risks_vulnerabilities', function (Blueprint $table) {
            $table->BigInteger('rsk_id')->unsigned();
            $table->BigInteger('vul_id')->unsigned();

            $table->primary(['rsk_id', 'vul_id']);
        });

        Schema::table('risks_vulnerabilities', function($table) {
            $table->foreign('rsk_id')->references('id')->on('risks');
            $table->foreign('vul_id')->references('id')->on('vulnerabilities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risks_vulnerabilities');
    }
};
