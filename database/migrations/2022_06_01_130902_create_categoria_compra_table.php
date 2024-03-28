<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_compra', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('categoria_id')-> unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->BigInteger('compra_id')-> unsigned();
            $table->foreign('compra_id')->references('id')->on('compras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoria_compra');
    }
}
