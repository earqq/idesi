<?php

use Illuminate\Database\Seeder;
use App\Database\Seeds\UsersSeeder;
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
    }
}
