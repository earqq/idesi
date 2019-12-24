<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 30)->unique();
            $table->string('descripcion', 100)->nullable();
            $table->boolean('condicion')->default(1);          
        });
        DB::table('roles')->insert(array('id'=>'1','nombre'=>'Administrador', 'descripcion'=>'Administradores de área'));
        DB::table('roles')->insert(array('id'=>'2','nombre'=>'Analista', 'descripcion'=>'Gestionar Prestamo'));
        DB::table('roles')->insert(array('id'=>'3','nombre'=>'Evaluador', 'descripcion'=>'Evaluador Común'));
        DB::table('roles')->insert(array('id'=>'4','nombre'=>'Evaluador Fianl', 'descripcion'=>'Evaluar prestamos'));
        DB::table('roles')->insert(array('id'=>'5','nombre'=>'Plataforma', 'descripcion'=>'Entregar Prestamo'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
