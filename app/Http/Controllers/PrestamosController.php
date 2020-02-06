<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestamo;
use Auth;
class PrestamosController extends Controller
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

    public function search($state,$text=''){
        $prestamos = Prestamo::leftJoin('clientes','prestamos.clientes_id',"=","clientes.id")
        ->leftJoin('naturals','clientes.id','=','naturals.clientes_id')
        ->leftJoin('juridicos','clientes.id','=','juridicos.clientes_id')
        ->where(function($query) use($state){
            if($state!='TODOS'){
                $query->where('prestamos.estado',$state);
            }
        })
        ->where(function($query) use($text){
            if($text!=''){
                $text=strtoupper($text);
                $query->orWhere('naturals.nombres', 'LIKE', "%{$text}%")
                ->orWhere('clientes.documento', 'LIKE', "%{$text}%")
                ->orWhere('naturals.apellidos', 'LIKE', "%{$text}%")
                ->orWhere('juridicos.razon_social', 'LIKE', "%{$text}%")
                ->orWhere('prestamos.producto', 'LIKE', "%{$text}%");
            }
        })  
        ->where(function($query){
            if(Auth::user()->idrol == '3')
                $query->where('prestamos.estado_analista','=', 'EVALUACION');
            elseif(Auth::user()->idrol == '4')
                $query->where('prestamos.estado_analista','!=', 'PROCESO');
            elseif(Auth::user()->idrol == '2')
                $query->where('prestamos.users_id','=', Auth::user()->id);  
        })
        ->select('clientes.documento',
                'naturals.nombres',
                'naturals.apellidos',
                'juridicos.razon_social', 
                'juridicos.celular', 
                'juridicos.direccion', 
                'prestamos.estado',
                'prestamos.estado_analista',
                'prestamos.producto',
                'prestamos.importe',
                'prestamos.plazo',
                'prestamos.cualitativa',
                'prestamos.cuantitativa',
                'prestamos.created_at',
                'prestamos.id')
        ->take(30)
        ->get();    
        return $prestamos;

    }

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
        //
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
