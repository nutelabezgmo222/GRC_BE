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
        Schema::create('users', function (Blueprint $table) {
            $table->id('u_id');
            $table->string('u_name', 100);
            $table->string('u_surname', 100);
            $table->string('u_email', 100)->unique();
            $table->string('u_password', 100);
            $table->date('u_registration_date');
            $table->dateTime('last_log_time');
            $table->tinyInteger('is_admin');
            $table->tinyInteger('r_access_level');
            $table->tinyInteger('cntrl_access_level');
            $table->string('remember_token', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
