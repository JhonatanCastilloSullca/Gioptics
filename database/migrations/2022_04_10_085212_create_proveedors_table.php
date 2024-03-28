<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {          
            $table->bigIncrements('id');
            $table->string('nombre',50);
            $table->string('tipo_documento',15)->nullable();
            $table->string('num_documento',15)->nullable();
            $table->string('direccion',250)->nullable();
            $table->string('celular',9)->nullable();
            $table->string('email',150)->nullable();
            $table->string('num_cuenta',250)->nullable();
            $table->string('descripcion',250)->nullable();
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
        Schema::dropIfExists('proveedors');
    }
}
