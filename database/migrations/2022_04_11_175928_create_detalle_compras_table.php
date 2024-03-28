<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_compras', function (Blueprint $table) {            
            $table->bigIncrements('id');
            $table->BigInteger('idCompra')-> unsigned();
            $table->foreign('idCompra')->references('id')->on('compras');
            $table->BigInteger('idProducto')-> unsigned();
            $table->foreign('idProducto')->references('id')->on('productos');

            $table->integer('cantidad');
            $table->decimal('precio',15,2);
            $table->string('especificacion',150)->nullable();
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
        Schema::dropIfExists('detalle_compras');
    }
}
