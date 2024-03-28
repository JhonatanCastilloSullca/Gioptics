<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaldocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saldocs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('idUsuario')->unsigned();
            $table->foreign('idUsuario')->references('id')->on('users');
            $table->BigInteger('idMedios')->unsigned();
            $table->foreign('idMedios')->references('id')->on('medios');
            $table->BigInteger('idCompra')->unsigned();
            $table->foreign('idCompra')->references('id')->on('compras');
            $table->BigInteger('idSucursal')->unsigned();
            $table->foreign('idSucursal')->references('id')->on('sucursals');
            $table->dateTime('fecha');
            $table->decimal('monto',11, 2);
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
        Schema::dropIfExists('saldocs');
    }
}
