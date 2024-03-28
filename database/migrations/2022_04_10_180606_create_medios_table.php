<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',75);
            $table->string('banco',50)->nullable();
            $table->string('numero',150)->nullable();
            $table->string('moneda',50)->nullable();
            $table->string('descripcion')->nullable();
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
        Schema::dropIfExists('medios');
    }
}
