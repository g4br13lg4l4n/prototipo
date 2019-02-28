<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('internalCode', 60);
            $table->string('name', 60);
            $table->char('shortName', 30)->nullable();
            $table->char('description', 250);
            $table->integer('stock');
            $table->decimal('purchasePrice', 18, 2)->nullable();
            $table->decimal('salePrice', 18, 2);
            $table->decimal('offerPrice', 18, 2)->nullable();
            $table->string('status', 12);
            $table->timestamps();
            
            //$table->unsignedInteger('company_id');
            //$table->foreign('company_id')->references('id')->on('companies');    

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
