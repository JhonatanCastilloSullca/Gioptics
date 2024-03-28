<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',50);
            $table->string('tipo_documento',15)->nullable();
            $table->string('num_documento',15);
            $table->string('edad')->nullable();
            $table->string('tipo',9)->nullable();
            $table->string('celular',15)->nullable();
            $table->string('email',150)->nullable();
            $table->date('fecha_nac')->nullable();
            $table->string('ocupacion',50)->nullable();
            $table->timestamps();
        });
        DB::table('pacientes')->insert(array('id'=>'1','nombre'=>'Sin Medida','tipo_documento'=>'Sin Medida','num_documento'=>'Sin Medida','celular'=>'999999999'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
