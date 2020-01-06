<?php

namespace App\Imports;

use App\Colegio;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class ColegiosImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Colegio|null
     */
    public function model(array $row)
    {
        return new Colegio([
           'nombre'     => $row[0],
           'nivel'    => $row[1], 
           'costo' => floatval($row[2]),
        ]);
    }
}