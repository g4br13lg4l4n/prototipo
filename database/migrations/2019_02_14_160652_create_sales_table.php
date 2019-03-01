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
            $table->integer('folio')->unique();
            $table->dateTime('saleDate');
            $table->dateTime('payDate')->nullable();
            $table->dateTime('cancellationDate')->nullable();
            $table->decimal('previousAmount',18,2);
            $table->decimal('tax',18,2);
            $table->decimal('amount',18,2);
            $table->string('saleStatus')->nullable($value = false);
            $table->string('shippingStatus')->nullable($value = false);
            $table->timestamps();

            //$table->unsignedInteger('client_id')->nullable(); /**SE DECLARA EL CAMPO PERO PUEDE SER NULL */
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
        });
        DB::statement("ALTER TABLE sales ADD CONSTRAINT chk_saleStatus CHECK ( saleStatus IN ('Pendiente','Pagado'));");
        DB::statement("ALTER TABLE sales ADD CONSTRAINT chk_shippingStatus CHECK ( shippingStatus IN ('Entregado','En Proceso'));");

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
