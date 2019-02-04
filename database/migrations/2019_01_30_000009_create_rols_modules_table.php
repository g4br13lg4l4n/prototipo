<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolsModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rols_modules', function (Blueprint $table) {
            $table->increments('id');
            //$table->timestamps();
            
            $table->unsignedInteger('rol_id');
            $table->unsignedInteger('module_id');
            $table->foreign('rol_id')->references('id')->on('rols');
            $table->foreign('module_id')->references('id')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rols_modules');
    }
}
