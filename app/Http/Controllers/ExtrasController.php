<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Colegio;
use App\Negocio;
use App\EntidadFinanciera;
class ExtrasController extends Controller
{
    public function giro(Request $request)
    {
        $negocios = Negocio::all();
        return $negocios;
    }
    public function colegios()
    {
        $colegio = Colegio::all();
        return $colegio;
    }
    public function entidades()
    {
        $entidades = EntidadFinanciera::all();
        return $entidades;
    } 
    public function colegioCosto(Request $request)
    {
        $colegio = Colegio::where("nivel",$request->grado)
                            ->where('nombre',$request->colegio)
                            ->select('costo')->first();
        return $colegio;
    } 
    public function doc(Request $request)
    {
        $doc = $request->documento;
        $datos = file_get_contents('https://app.easybill.pe/tools/consult/identification/'.$doc);

        return $datos;
    }
}   
