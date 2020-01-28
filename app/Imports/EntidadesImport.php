<?php

namespace App\Imports;

use App\EntidadFinanciera;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class EntidadesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return EntidadFinanciera|null
     */
    public function model(array $row)
    {
        return new EntidadFinanciera([
            'nombre'     => $row[0],
        ]);
    }
}