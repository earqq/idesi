<?php

use Illuminate\Database\Seeder;
use App\Imports\ColegiosImport;
use Maatwebsite\Excel\Facades\Excel;
class DataColeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new ColegiosImport, env('RUTA').'/public/data_colegios.xlsx');
    }
}
