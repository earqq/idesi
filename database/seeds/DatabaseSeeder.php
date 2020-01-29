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
        $this->call(DataEntidadesSeeder::class);
        $this->call(Location2Seeder::class);
    }
}
