<?php

use Illuminate\Database\Seeder;
use App\Imports\NegociosImport;
use Maatwebsite\Excel\Facades\Excel;
class DataNegociosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new NegociosImport, env('RUTA').'/public/data_negocios.xlsx');
    }
}
