<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_rols', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('rol_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rol_id')->references('id')->on('rols');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_rols');
    }
}
