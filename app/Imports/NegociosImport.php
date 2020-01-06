<?php

namespace App\Imports;

use App\Negocio;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class NegociosImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Negocio|null
     */
    public function model(array $row)
    {
        return new Negocio([
           'giro_negocio'     => $row[0],
           'margen_maximo'    => floatval($row[1]), 
           'costo_ventas' => floatval($row[2]),
        ]);
    }
}