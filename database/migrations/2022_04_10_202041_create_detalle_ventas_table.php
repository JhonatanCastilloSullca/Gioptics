<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('idVenta')-> unsigned();
            $table->foreign('idVenta')->references('id')->on('ventas');
            $table->BigInteger('idProducto')-> unsigned();
            $table->foreign('idProducto')->references('id')->on('productos');
            $table->BigInteger('idMedidas')-> unsigned();
            $table->foreign('idMedidas')->references('id')->on('medidas');
            $table->string('especificacion',15,2)->nullable();
            $table->integer('cantidad');
            $table->decimal('precio',15,2);
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
        Schema::dropIfExists('detalle_ventas');
    }
}
