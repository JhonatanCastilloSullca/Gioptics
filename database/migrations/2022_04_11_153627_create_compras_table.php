<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->bigIncrements('id');           
            $table->BigInteger('idMedios')-> unsigned();
            $table->foreign('idMedios')->references('id')->on('medios');
            $table->BigInteger('idUsuario')-> unsigned();
            $table->foreign('idUsuario')->references('id')->on('users');
            $table->BigInteger('idSucursal')-> unsigned();
            $table->foreign('idSucursal')->references('id')->on('sucursals');            
            $table->date('fecha');
            $table->string('comprobante',15);
            $table->string('numero',15)->nullable();
            $table->decimal('acuenta',15,2);
            $table->decimal('saldo',15,2);
            $table->decimal('total',15,2);
            $table->string('observacion',500)->nullable();
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
        Schema::dropIfExists('compras');
    }
}
