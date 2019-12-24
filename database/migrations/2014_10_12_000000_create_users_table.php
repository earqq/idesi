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
            $table->increments('id');
            $table->string('name');
            $table->string('tipo_documento', 20)->nullable();
            $table->string('num_documento', 20)->unique();
            $table->string('direccion', 70)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('email')->unique();
            $table->string('usuario')->unique();
            $table->string('password');
            $table->boolean('condicion')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            
            $table->integer('idrol')->unsigned();
            $table->foreign('idrol')->references('id')->on('roles');

        });


        DB::table('users')->insert(array('id'=>'1','name'=>'Administrador','tipo_documento'=>'DNI','num_documento'=>'77777777','direccion'=>'Jr abtao','telefono'=>'999999999',
        'email'=>'admin@gmail.com','usuario'=>'admin', 
        'password'=>'$2y$10$5KqKxxAuvqz.69p7vPryt.bOrVOaZOyCY25LIBIfFmmeutQ7oDH8a', 'condicion'=>'1'
        ,'idrol'=>'1'));

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
