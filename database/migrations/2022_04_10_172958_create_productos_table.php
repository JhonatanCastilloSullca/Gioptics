<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',150)->nullable();
            $table->string('codigo',100)->nullable();
            $table->integer('stock')->nullable();
            $table->decimal('precio',5, 2)->nullable();
            $table->decimal('precio_compra',5, 2)->nullable();
            $table->string('estado',15);
            $table->BigInteger('proveedor_id')-> unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedors');
            $table->BigInteger('categoria_id')-> unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->BigInteger('sucursal_id')-> unsigned();
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->BigInteger('unidad_id')-> unsigned();
            $table->foreign('unidad_id')->references('id')->on('unidads');

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
        Schema::dropIfExists('productos');
    }
}
