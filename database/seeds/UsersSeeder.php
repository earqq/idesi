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
        $user =  new user;
        $user->name = 'Administrador';
        $user->usuario = 'admin';
        $user->password = bcrypt('admin');
        $user->nivel = 1;
        $user->save();
        
        $user =  new user;
        $user->name = 'Evaluador final';
        $user->usuario = 'efinal';
        $user->password = bcrypt('efinal');
        $user->nivel = 2;
        $user->save();

        $user =  new user;
        $user->name = 'Evaluador';
        $user->usuario = 'evaluador';
        $user->password = bcrypt('evaluador');
        $user->nivel = 3;

        $user->save();
        $user =  new user;
        $user->name = 'Analista';
        $user->usuario = 'analista';
        $user->password = bcrypt('analista');
        $user->nivel = 4;
        $user->save();

        $user =  new user;
        $user->name = 'Plataforma';
        $user->usuario = 'plataforma';
        $user->password = bcrypt('plataforma');
        $user->nivel = 5;
        $user->save();       
    }
}
