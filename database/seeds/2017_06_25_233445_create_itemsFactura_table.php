<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('itemFactura', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion',255);
            $table->integer('cantidad');
            $table->float('precioUnitario');
            $table->float('subtotal');

            $table->integer('idFactura')->unsigned();
            $table->foreign('idFactura')->references('id')->on('factura');

            //$table->softDeletes();
            //$table->is_delete();
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
         Schema::drop('itemFactura');
    }
}
