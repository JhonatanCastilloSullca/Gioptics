<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('idCliente')-> unsigned();
            $table->foreign('idCliente')->references('id')->on('clientes');
            $table->BigInteger('idUsuario')-> unsigned();
            $table->foreign('idUsuario')->references('id')->on('users');
            $table->BigInteger('idMedios')-> unsigned();
            $table->foreign('idMedios')->references('id')->on('medios');
            $table->BigInteger('idSucursal')-> unsigned();
            $table->foreign('idSucursal')->references('id')->on('sucursals');
            $table->date('fecha');
            $table->decimal('descuento',15,2);
            $table->decimal('acuenta',15,2);
            $table->decimal('saldo',15,2);
            $table->decimal('total',15,2);
            $table->string('observacion',150)->nullable();
            $table->string('estado',15);
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
        Schema::dropIfExists('ventas');
    }
}
