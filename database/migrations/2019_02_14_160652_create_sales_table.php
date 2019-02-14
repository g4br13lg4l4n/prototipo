<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('folio')->unique();
            $table->dateTime('saleDate');
            $table->dateTime('payDate')->nullable();
            $table->dateTime('cancellationDate')->nullable();
            $table->decimal('previousAmount',18,2);
            $table->decimal('tax',18,2);
            $table->decimal('amount',18,2);
            $table->char('saleStatus',15);
            $table->char('shippingStatus',15);
            $table->timestamps();

            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
