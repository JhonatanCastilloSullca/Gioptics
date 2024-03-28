<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',50);
            $table->string('direccion',100)->nullable();
            $table->string('telefono',9)->nullable();
            $table->string('estado',15);
            $table->timestamps();
        });
        DB::table('sucursals')->insert(array('id'=>'1','nombre'=>'Principal','direccion'=>'','telefono'=>'','estado'=>'Activo'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursals');
    }
}
