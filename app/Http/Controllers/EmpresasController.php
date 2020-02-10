<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use DB;
use Auth;
use App\Empresa;
use App\Obligacion;
use App\RepresentanteLegal;
use App\Director;
use App\Accionista;
use App\Declaracion;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
class EmpresasController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        // return $request->input('distritos_id');

        try{

            DB::beginTransaction();

            \Log::alert($request->all());            
            $cliente = Cliente::where('documento',$request->documento)->first();
            if($cliente){
                DB::rollBack();
                return [
                    'success' => false, 
                ];
            }
            else{
                
                $cliente = new Cliente();
                $cliente->tipo_documento ='RUC';
                $cliente->user_id = Auth::user()->id;
                $cliente->documento = $request->documento;
                $cliente->codigo = $request->codigo;
                $cliente->tipo_cliente = $request->tipo_cliente;
                $cliente->pais = $request->pais;
                $cliente->ubicacion_departamento = $request->ubicacion_departamento;
                $cliente->ubicacion_provincia = $request->ubicacion_provincia;
                $cliente->ubicacion_distrito = $request->ubicacion_distrito;
                $cliente->estado = 0;
                $cliente->ubicacion_direccion_declarada= $request->ubicacion_direccion_declarada;    
                $cliente->ubicacion_direccion_sistema= $request->ubicacion_direccion_declarada;    
                $cliente->ubicacion_numero= $request->ubicacion_numero;    
                $cliente->ubicacion_manzana= $request->ubicacion_manzana;    
                $cliente->ubicacion_lote= $request->ubicacion_lote;    
                $cliente->ubicacion_nro_departamento= $request->ubicacion_nro_departamento;
                $cliente->ubicacion_interior= $request->ubicacion_interior;
                $cliente->ubicacion_piso= $request->ubicacion_piso;
                $cliente->ubicacion_referencia= $request->ubicacion_referencia;
                $cliente->telefono= $request->telefono;
                $cliente->celular= $request->celular;
                $cliente->email= $request->email;
                $cliente->save();
                
                $empresa = new Empresa();
                $empresa->razon_social= $request->empresa['razon_social'];    
                $empresa->nombre_comercial= $request->empresa['nombre_comercial'];    
                $empresa->actividad_principal= $request->empresa['actividad_principal'];    
                $empresa->partida_registral= $request->empresa['partida_registral'];    
                $empresa->oficina_principal= $request->empresa['oficina_principal'];    
                $empresa->tipo_negocio= $request->empresa['tipo_negocio'];    
               
                $empresa->cliente_id= $cliente->id;
                $empresa->save();

                foreach ($request->empresa['representantes'] as $ep=>$rp) { 
                    $representanteLegal= new RepresentanteLegal;
                    $representanteLegal->nombres = $rp['nombres'];
                    $representanteLegal->documento = $rp['documento'];
                    $representanteLegal->cargo = $rp['cargo'];
                    $representanteLegal->empresa_id= $empresa->id;
                    $representanteLegal->save();
                }

                $representante = RepresentanteLegal::where('empresa_id',$empresa->id)->get();

                foreach ($request->empresa['directores'] as $ep=>$dr) {
                    $director= new Director;
                    $director->nombres = $dr['nombres'];
                    $director->documento = $dr['documento'];
                    $director->cargo = $dr['cargo'];
                    $director->empresa_id= $empresa->id;
                    $director->save();
                }

                $directores = Director::where('empresa_id',$empresa->id)->get();

                foreach ($request->empresa['accionistas'] as $ep=>$ac) {
                    $accionista= new Accionista;
                    $accionista->nombres = $ac['nombres'];
                    $accionista->documento = $ac['documento'];
                    $accionista->empresa_id= $empresa->id;
                    $accionista->save();
                }
               
                $accionistas = Accionista::where('empresa_id',$empresa->id)->get();

                $obligacion = New Obligacion;
                $obligacion->inscripcion= $request->asociativa['inscripcion'];    
                $obligacion->aporte= $request->asociativa['aporte'];    
                $obligacion->cliente_id= $cliente->id;
                $obligacion->save();

                $declaracion = New Declaracion;
                $declaracion->uif= $request->declaracion['uif'];    
                $declaracion->observaciones= $request->declaracion['observaciones'];    
                $declaracion->cliente_id= $cliente->id;
                $declaracion->save();
                
                $pdf = PDF::loadView('reportes.inscripcionJuridico',compact('cliente','empresa','representante',
                'directores','accionistas','obligacion','declaracion'));

                if (Storage::put('public/'.$cliente->documento.'_'.$cliente->id.'/general/documento/inscripcion_de_socio.pdf', $pdf->output())){
                }


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
