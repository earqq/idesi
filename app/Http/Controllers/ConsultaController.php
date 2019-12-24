<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function dni(Request $request)
    {
        $dni = $request->documento;
        $datos = file_get_contents('https://app.easybill.pe/tools/consult/identification/'.$dni);

        return $datos;
    }
}
