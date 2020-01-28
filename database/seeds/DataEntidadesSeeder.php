<?php

use Illuminate\Database\Seeder;
use App\Imports\EntidadesImport;
use Maatwebsite\Excel\Facades\Excel;
class DataEntidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new EntidadesImport, env('RUTA').'/public/data_entidades.xlsx');
    }
}
