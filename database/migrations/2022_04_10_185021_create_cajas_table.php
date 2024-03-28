<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion',150);
            $table->date('fecha',100)->nullable();
            $table->decimal('monto',5,2)->nullable();
            $table->string('documento',15)->nullable();
            $table->string('numero',15)->nullable();
            $table->string('tipo',50)->nullable();
            $table->BigInteger('idUsuario')-> unsigned();
            $table->foreign('idUsuario')->references('id')->on('users');
            $table->BigInteger('idMedios')-> unsigned();
            $table->foreign('idMedios')->references('id')->on('medios');
            $table->BigInteger('idSucursal')-> unsigned();
            $table->foreign('idSucursal')->references('id')->on('sucursals');
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
        Schema::dropIfExists('cajas');
    }
}
