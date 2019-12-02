<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestamo;
use App\Evaluacion;

class EvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function prestamos()
    {
        $pretamos = Prestamo::join('clientes','prestamos.clientes_id',"=","clientes.id")
                              ->select('clientes.nombres','clientes.apellidos','prestamos.estado','prestamos.id')->get();
        return $pretamos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prestamo = Prestamo::find($id);
        return $prestamo;
    }


    // public function evaluar($id)
    // {
    //     $prestamo = Prestamo::find($id);
    //     return $prestamo;
    // }

    public function evaluar(Request $request)
    {
        if($request['tipo']=='APROBADO'){
            $evaluacion = new Evaluacion();
            $evaluacion->producto  = $request['producto'] ;
            $evaluacion->aporte  = $request['aporte'];
            $evaluacion->importe  = $request['importe'];
            $evaluacion->plazo  = $request['plazo'];
            $evaluacion->cuotas  = $request['cuotas'];
            $evaluacion->tasa  = $request['tasa'];
            $evaluacion->estado  = $request['tipo'];
            $evaluacion->prestamos_id  = $request['prestamos_id'];
            $evaluacion->users_id  = '1';
            $evaluacion->save();
            // $prestamo = Prestamo::find($request['prestamos_id']);
            // $prestamo->estado = $request['tipo'];
            // $prestamo->save();
        }
        elseif($request['tipo']=='OBSERVADO'){

        }
        elseif($request['tipo']=='DESAPROBADO'){
            $evaluacion = new Evaluacion();
            $evaluacion->producto  = 00;
            $evaluacion->aporte  = 00;
            $evaluacion->importe  = 00;
            $evaluacion->plazo  = 00;
            $evaluacion->cuotas  = 00;
            $evaluacion->tasa  = 00;
            $evaluacion->estado  = $request['tipo'];
            $evaluacion->prestamos_id  = $request['prestamos_id'];
            $evaluacion->users_id  = '1';
            $evaluacion->save();
        }
        // return $request['tipo'];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
