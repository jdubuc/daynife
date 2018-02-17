<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('factura', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion',255);
            $table->integer('cantidad');
            $table->float('subtotal');
            $table->float('iva');
            $table->float('total');
            $table->integer('numeroFactura');
            $table->integer('numeroControl')->nullable();
            $table->date('fechaEmision');
            $table->date('fechaDespacho');
            $table->date('fechaPago');

            $table->integer('idTipo')->unsigned();
            $table->foreign('idTipo')->references('id')->on('tipoFactura');


            $table->integer('idEmpresa')->unsigned();
            $table->foreign('idEmpresa')->references('id')->on('empresa');

            //$table->softDeletes();
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
         Schema::drop('factura');
    }
}
