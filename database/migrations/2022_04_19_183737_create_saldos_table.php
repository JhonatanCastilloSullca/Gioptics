<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaldosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saldos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('idUsuario')->unsigned();
            $table->foreign('idUsuario')->references('id')->on('users');
            $table->BigInteger('idMedios')->unsigned();
            $table->foreign('idMedios')->references('id')->on('medios');
            $table->BigInteger('idVenta')->unsigned();
            $table->foreign('idVenta')->references('id')->on('ventas');
            $table->BigInteger('idSucursal')->unsigned();
            $table->foreign('idSucursal')->references('id')->on('sucursals');
            $table->dateTime('fecha');
            $table->decimal('monto',11, 2);
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
        Schema::dropIfExists('saldos');
    }
}
