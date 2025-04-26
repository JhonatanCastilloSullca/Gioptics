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
            $table->BigInteger('documento_id')-> unsigned();
            $table->foreign('documento_id')->references('id')->on('documentos');
            $table->integer('nume_doc');
            $table->date('fecha');
            $table->decimal('descuento',15,2);
            $table->decimal('acuenta',15,2);
            $table->decimal('saldo',15,2);
            $table->decimal('total',15,2);
            $table->string('observacion',150)->nullable();
            $table->string('sunat',1)->default(0);
            $table->string('factura',1)->default(0);
            $table->string('descripcion',500)->nullable();
            $table->string('code_note',2)->nullable();
            $table->BigInteger('factura_id')->unsigned()->nullable();
            $table->foreign('factura_id')->references('id')->on('ventas');
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
