<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array('id'=>'1','nombre'=>'Administrador', 'descripcion'=>'Administradores de área'));
        DB::table('roles')->insert(array('id'=>'2','nombre'=>'Analista', 'descripcion'=>'Gestionar Prestamo'));
        DB::table('roles')->insert(array('id'=>'3','nombre'=>'Evaluador', 'descripcion'=>'Evaluador Común'));
        DB::table('roles')->insert(array('id'=>'4','nombre'=>'Evaluador Final', 'descripcion'=>'Evaluar prestamos'));
        DB::table('roles')->insert(array('id'=>'5','nombre'=>'Plataforma', 'descripcion'=>'Entregar Prestamo'));
        DB::table('users')->insert(array('id'=>'1','name'=>'Administrador','tipo_documento'=>'DNI','num_documento'=>'77777777','direccion'=>'Jr abtao','telefono'=>'999999999',
        'email'=>'admin@gmail.com','usuario'=>'admin', 
        'password'=>'$2y$10$5KqKxxAuvqz.69p7vPryt.bOrVOaZOyCY25LIBIfFmmeutQ7oDH8a', 'condicion'=>'1'
        ,'idrol'=>'1'));
    }
}
