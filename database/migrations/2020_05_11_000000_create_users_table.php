<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',50);
            $table->string('apellido',100)->nullable();
            $table->string('tipo_documento',15)->nullable();
            $table->string('num_documento',15)->nullable();
            $table->string('celular',9)->nullable();
            $table->string('email',25)->nullable();
            $table->string('rol',30)->nullable();
            $table->string('usuario',50)->unique();;        
            $table->string('password',100);
            $table->BigInteger('idSucursal')-> unsigned();
            $table->foreign('idSucursal')->references('id')->on('sucursals');
            $table->string('estado',15);
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(array('id'=>'1','nombre'=>'David','apellido'=>'Miranda Tarco','tipo_documento'=>'DNI','num_documento'=>'48507551','celular'=>'982733597','email'=>'dmirandatarco@gmail.com','rol'=>'Gerencia','usuario'=>'david','password'=>'$2y$10$NtFWYlOGWPewcw7NpC6wReaDkC6Z/7nMilspRUCbXmKJC6GTKbAou','idSucursal'=>1,'estado'=>'1','remember_token'=>NULL,'created_at'=>'2020-07-06 06:58:12','updated_at'=>'2022-04-12 14:54:26'));
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
