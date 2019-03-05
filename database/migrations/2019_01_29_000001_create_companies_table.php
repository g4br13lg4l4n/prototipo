<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('fiscalName',100);
            $table->string('rfc',13);
            $table->string('zipCode',6);
            $table->string('colony',20);
            $table->string('street',25);
            $table->integer('intNum');
            $table->integer('extNum');
            $table->integer('phone');
            $table->integer('mobile');
            $table->integer('email');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
