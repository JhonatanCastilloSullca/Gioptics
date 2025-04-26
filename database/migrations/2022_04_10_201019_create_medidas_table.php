<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medidas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('odvle',5);
            $table->string('odvlc',5);
            $table->string('odvleje',5);
            $table->string('odvce',5);
            $table->string('odvcc',5);
            $table->string('odvceje',5);
            $table->string('oivle',5);
            $table->string('oivlc',5);
            $table->string('oivleje',5);
            $table->string('oivce',5);
            $table->string('oivcc',5);
            $table->string('oivceje',5);
            $table->string('dip',5)->nullable();
            $table->string('add',5)->nullable();
            $table->string('indicaciones',256)->nullable();
            $table->date('fecha');
            $table->BigInteger('idUsuario')-> unsigned();
            $table->foreign('idUsuario')->references('id')->on('users');
            $table->BigInteger('idVendedor')-> unsigned();
            $table->foreign('idVendedor')->references('id')->on('users');
            $table->BigInteger('idPaciente')-> unsigned();
            $table->foreign('idPaciente')->references('id')->on('pacientes');
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
        Schema::dropIfExists('medidas');
    }
}
