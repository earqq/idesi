<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Juridico;
USE App\Prestamo;
class InicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = Cliente::where('estado','1')->count();
        $prestamo_rechazado = Prestamo::where('estado','RECHAZADO')->count();
        $prestamo_total = Prestamo::where('estado','APROBADO')->count();
        $prestamo_pendiente = Prestamo::where('estado','PENDIENTE')->count();

        /* ULTIMOS CLIENTES */
        $clientes = Cliente::join('naturals','clientes.id','=','naturals.clientes_id')->select('clientes.documento','naturals.nombres','naturals.apellidos','clientes.created_at', 'clientes.estado')->latest()->take(7)->get();
        // $juridico = Juridico::join('juridicos','clientes.id','=','juridicos.clientes_id')->select('clientes.documento as juridico_documento','juridicos.razon_social','clientes.created_at as juridico_creacion')->latest()->take(7)->get();
        $prestamos = Prestamo::latest()->take(7)->get();
        return compact('cliente','prestamo_rechazado','prestamo_total','prestamo_pendiente','clientes','prestamos');
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
