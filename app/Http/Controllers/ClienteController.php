<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Prestamo;
use App\Departamento;
use App\Distrito;
use App\Aval;
use App\Garantia;
use App\Provincia;
use App\Vista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return Cliente::orderBy('id')->paginate(10);
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
        if (!$request->ajax()) return redirect('/');

        try{

            DB::beginTransaction();

            
            $cliente = Cliente::where('documento',$request->input('documento'))->first();
            if($cliente){
                DB::rollBack();
                return [
                    'success' => false,
                    'data' => 'Cliente ya existe'
                ];
            }
            else{
                $cliente = new Cliente($request->all());
                $cliente->save();
    
                DB::commit();
                return [
                    'success' => true,
                    'data' => 'Cliente creado',
                ];
    
            }
 

        } catch (Exception $e){
            return [
                'success' => false,
            ];
            DB::rollBack();
        }
       
    }

    public function visitaStore(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $visita = new Vista($request->all());
        $visita->save();
        return [
            'success' => true,
            'data' => 'Cliente creado',
        ];
        
       
    }

    public function datos()
    {
       $departments = Departamento::where('activo',1)->orderBy('descripcion')->get();
        $provinces = Provincia::where('activo',1)->orderBy('descripcion')->get();
        $districts = Distrito::where('activo',1)->orderBy('descripcion')->get();
        return  ['departments'=>$departments, 'provinces'=>$provinces, 'districts'=>$districts];
       
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($documento)
    {
        $cliente = Cliente::where('documento',$documento)
        ->select('id','documento','nombres','apellidos','nacimiento')
        ->first();

        $prestamos = Prestamo::where('clientes_id',$cliente->id)->get();

        return ['cliente'=>$cliente, 'prestamos'=>$prestamos];
        
    }

    public function visitas($documento)
    {
        if (!$request->ajax()) return redirect('/');
        $vistas = Vista::where('prestamos_id',$documento)->get();

        return $vistas;
        
    }

    public function general($documento)
    {
        return Cliente::where('documento',$documento)->first();
        
    }
    public function prestamo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{

            DB::beginTransaction();
  
            $cliente = Cliente::where('documento',$request->input('documento'))->first();
            $cliente->departamentos_id = $request->input('departamentos_id');
            $cliente->distritos_id= $request->input('distritos_id');
            $cliente->provincias_id = $request->input('provincias_id');
            $cliente->celular = $request->input('celular');
            $cliente->centro_laboral = $request->input('centro_laboral');
            $cliente->direccion = $request->input('direccion');
            $cliente->direccion_laboral = $request->input('direccion_laboral');
            $cliente->estado_civil = $request->input('estado_civil');
            $cliente->nacimiento = $request->input('nacimiento');
            $cliente->ocupacion = $request->input('ocupacion');
            $cliente->referencia = $request->input('referencia');
            $cliente->telefono = $request->input('telefono');
            $cliente->tipo_domicilio =  $request->input('tipo_domicilio');
            $cliente->centro_laboral_conyugue= $request->input('centro_laboral_conyugue');
            $cliente->direccion_laboral_conyugue = $request->input('direccion_laboral_conyugue') ;
            $cliente->documento_conyugue = $request->input('documento_conyugue') ;
            $cliente->estado_civil_conyugue =  $request->input('estado_civil_conyugue') ;
            $cliente->nacimiento_conyugue =  $request->input('nacimiento_conyugue');
            $cliente->nombres_conyugue =  $request->input('nombres_conyugue');
            $cliente->apellidos_conyugue =  $request->input('apellidos_conyugue');
            $cliente->ocupacion_conyugue =  $request->input('ocupacion_conyugue');
            $cliente->telefono_conyugue =  $request->input('telefono_conyugue') ;
            $cliente->celular_conyugue =  $request->input('celular_conyugue');

            $cliente->save();

            $prestamo = new Prestamo();
            $prestamo->clientes_id = $cliente->id;
            $prestamo->users_id = 1;
            $prestamo->producto = $request->input('producto');
            $prestamo->forma = $request->input('forma');
            $prestamo->importe = $request->input('importe');
            $prestamo->aporte = $request->input('aporte');
            $prestamo->plazo = $request->input('plazo');
            $prestamo->cuotas = $request->input('cuotas');
            $prestamo->tasa = $request->input('tasa');
            $prestamo->comentarios = $request->input('comentarios');
            $prestamo->estado = $request->input('estado');
            $prestamo->save();

            foreach ($request->avals as $ep=>$avals) {
                $aval= new Aval;
                $aval->documento = $avals['documento'];
                $aval->nombres = $avals['nombres'];
                $aval->apellidos = $avals['apellidos'];
                $aval->estado_civil = $avals['estado_civil'];
                $aval->ocupacion = $avals['ocupacion'];
                $aval->telefono = $avals['telefono'];
                $aval->celular = $avals['celular'];
                $aval->direccion = $avals['direccion'];
                $aval->distrito = $avals['distrito'];
                $aval->centro_laboral = $avals['centro_laboral'];
                $aval->direccion_laboral = $avals['direccion_laboral'];
                $aval->prestamos_id = $prestamo->id;
                $aval->save();
            }

            foreach ($request->garantias as $ep=>$garantias) {
                $garantia= new Garantia;
                $garantia->bien_garantia = $garantias['bien_garantia'];
                $garantia->inscripcion = $garantias['inscripcion'];
                $garantia->declaracion_jurada = $garantias['declaracion_jurada'];
                $garantia->prestamos_id = $prestamo->id;
                $garantia->save();
            }
 
            DB::commit();

            return [
                'success' => true,
                'data' => 'Cliente creado',
            ];

        } catch (Exception $e){
            return [
                'success' => false,
            ];
            DB::rollBack();
        }

        
    }

    public function prestamoVer($prestamo)
    {
        $prestamo= Prestamo::find($prestamo);

        $cliente = Cliente::where('id',$prestamo->clientes_id)->first();
        $avals = Aval::where('prestamos_id',$prestamo->id)->get();
        $garantias = Garantia::where('prestamos_id',$prestamo->id)->get();

        return compact('prestamo','cliente','avals','garantias');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
