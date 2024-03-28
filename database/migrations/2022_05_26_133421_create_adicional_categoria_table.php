<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdicionalCategoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adicional_categoria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('adicional_id')-> unsigned();
            $table->foreign('adicional_id')->references('id')->on('adicionals');
            $table->BigInteger('categoria_id')-> unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adicional_categoria');
    }
}
