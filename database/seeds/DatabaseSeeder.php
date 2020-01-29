<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    // use User
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(DataNegociosSeeder::class);



        $this->call(DataColegiosSeeder::class);
<<<<<<< HEAD
        $this->call(DataEntidadSeeder::class);

=======
        $this->call(DataEntidadesSeeder::class);
        $this->call(DataLocationSeeder::class);
>>>>>>> c56d5ecf31d5df019757bda4855f0ab0296cd77c
    }
}
