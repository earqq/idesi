<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function doc(Request $request)
    {
        $doc = $request->documento;
        $datos = file_get_contents('https://app.easybill.pe/tools/consult/identification/'.$doc);

        return $datos;
    }
   
}
