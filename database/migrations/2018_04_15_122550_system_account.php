<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('system_account', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('login_name');
            $table->string('password');
            $table->integer('group');
            $table->string('auth');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('system_account');
    }
}
