<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaracteristicaProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caracteristica_producto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('caracteristica_id')-> unsigned();
            $table->foreign('caracteristica_id')->references('id')->on('caracteristicas');
            $table->BigInteger('producto_id')-> unsigned();
            $table->foreign('producto_id')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caracteristica_producto');
    }
}
