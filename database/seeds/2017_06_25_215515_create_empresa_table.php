<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',60);
            $table->string('longName',60);
            $table->string('email')->unique();
            $table->integer('phoneNumer1');
            $table->integer('phoneNumer2');
            $table->string('address',255);
            $table->string('rif',11);
            $table->string('location',255);
            $table->string('deleveryAddress',255);
            $table->string('attendant',255);
            $table->string('webPage');
            
           //$table->softDeletes();
           // $table->is_delete();
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
         Schema::drop('empresa');
    }
}
