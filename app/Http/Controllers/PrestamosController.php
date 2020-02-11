<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestamo;
use Auth;
use DB;
use App\Persona;
use App\Conyuge;
use App\Aval;
use App\Cliente;
use App\Subido;
use App\RepresentanteLegal;
use App\Garantia;
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
        ->leftJoin('evaluacions','evaluacions.prestamos_id','prestamos.id')
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
            if(Auth::user()->nivel == '3'){
                $query->where('prestamos.estado','PENDIENTE');
                // ->where('evaluacions.users_id','!=',Auth::user()->id);
            }
            elseif(Auth::user()->nivel == '4')
                $query->where('prestamos.users_id','=', Auth::user()->id);  
        })
        ->select('clientes.documento',
                'naturals.nombres',
                'naturals.apellidos',
                'juridicos.razon_social', 
                'juridicos.celular', 
                'juridicos.direccion', 
                'prestamos.estado',
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
        if (!$request->ajax()) return redirect('/');

        try{

            \Log::alert($request->all());

            DB::beginTransaction();

            $prestamo = new Prestamo();                
            if($request->id!=0)
                $prestamo = Prestamo::find($request->id);
 
            $prestamo->cliente_id = $request->cliente["id"];
            $prestamo->user_id = Auth::user()->id;
            $prestamo->monto_inicial = $request->monto_inicial;
            $prestamo->cuotas_inicial = $request->cuotas_inicial;
            $prestamo->disponibilidad_pago_inicial = $request->disponibilidad_pago_inicial;
            $prestamo->destino_inicial = $request->destino_inicial;
            $prestamo->forma_inicial = $request->forma_inicial;
            $prestamo->meses = $request->meses;
            $prestamo->producto = $request->producto;
            $prestamo->forma = $request->forma;
            $prestamo->importe = $request->importe;
            $prestamo->aporte = $request->aporte;
            $prestamo->probabilidad_infocorp = $request->probabilidad_infocorp;
            $prestamo->cuotas = $request->cuotas;
            $prestamo->cuota_sistema = $request->cuota_sistema;
            $prestamo->tasa = $request->tasa;
            $prestamo->comentarios = $request->comentarios;
            $prestamo->estado = $request->estado;
            
            $prestamo->save();
            
            $cliente=Cliente::find($request->cliente['id']);
            $cliente->celular = $request->cliente['celular'];
            $cliente->telefono = $request->cliente['telefono'];
            $cliente->ubicacion_direccion_declarada = $request->cliente['ubicacion_direccion_declarada'];
            $cliente->ubicacion_referencia = $request->cliente['ubicacion_referencia'];
            $cliente->ubicacion_departamento = $request->cliente['ubicacion_departamento'];
            $cliente->ubicacion_provincia = $request->cliente['ubicacion_provincia'];
            $cliente->ubicacion_provincia = $request->cliente['ubicacion_provincia'];
            $cliente->ubicacion_referencia = $request->cliente['ubicacion_referencia'];
            $cliente->ubicacion_referencia = $request->cliente['ubicacion_referencia'];
            $cliente->save();

            if($cliente->tipo_cliente==1){
                //Prestamos para personas
                $persona = $cliente->persona;
                $persona->nombres = $request->cliente['persona']['nombres'];
                $persona->apellidos = $request->cliente['persona']['apellidos'];
                $persona->centro_laboral = $request->cliente['persona']['centro_laboral'];
                $persona->direccion_laboral = $request->cliente['persona']['direccion_laboral'];
                $persona->estado_civil = $request->cliente['persona']['estado_civil'];
                $persona->fecha_nacimiento = $request->cliente['persona']['fecha_nacimiento'];
                $persona->ocupacion = $request->cliente['persona']['ocupacion'];
                $persona->tipo_domicilio =  $request->cliente['persona']['tipo_domicilio'];
                $persona->save();
                if(strlen($request->cliente['persona']['conyuge']['documento'])>5){
                    $conyugue = new Conyuge;
                    if($persona->conyuge)
                    $conyugue = $persona->conyuge;
                    $conyugue->centro_laboral= $request->cliente['persona']['conyuge']['centro_laboral'];
                    $conyugue->direccion_centro_laboral = $request->cliente['persona']['conyuge']['direccion_centro_laboral'] ;
                    $conyugue->documento = $request->cliente['persona']['conyuge']['documento'] ;
                    $conyugue->estado_civil =  $request->cliente['persona']['conyuge']['estado_civil'] ;
                    $conyugue->fecha_nacimiento =  $request->cliente['persona']['conyuge']['fecha_nacimiento'];
                    $conyugue->nombres =  $request->cliente['persona']['conyuge']['nombres'];
                    $conyugue->ocupacion =  $request->cliente['persona']['conyuge']['ocupacion'];
                    $conyugue->telefono =  $request->cliente['persona']['conyuge']['telefono'] ;
                    $conyugue->celular =  $request->cliente['persona']['conyuge']['celular'];
                    $conyugue->trabaja =  $request->cliente['persona']['conyuge']['trabaja'];
                    $conyugue->socio =  $request->cliente['persona']['conyuge']['socio'];
                    $conyugue->codigo_socio =  $request->cliente['persona']['conyuge']['codigo_socio'];
                    $conyugue->aporte_socio =  $request->cliente['persona']['conyuge']['aporte_socio'];
                    $conyugue->persona_id = $persona->id;   
                    $conyugue->save();
                }
            }else{ //Prestamos para empresas
                $empresa= $cliente->empresa;
                $empresa->razon_social=$request->cliente['empresa']['razon_social'];
                $empresa->nombre_comercial=$request->cliente['empresa']['nombre_comercial'];
                $empresa->actividad_principal=$request->cliente['empresa']['actividad_principal'];
                $empresa->partida_registral=$request->cliente['empresa']['partida_registral'];
                $empresa->oficina_principal=$request->cliente['empresa']['oficina_principal'];
                $empresa->tipo_negocio=$request->cliente['empresa']['tipo_negocio'];
                $empresa->fecha_constitucion=$request->cliente['empresa']['fecha_constitucion'];
                $empresa->save();

                $representante= new RepresentanteLegal;
                if($request->cliente['empresa']['representante']['id'])
                    $representante=RepresentanteLegal::find($request->cliente['empresa']['representante']['id']);
                $representante->nombres=$request->cliente['empresa']['representante']['nombres'];
                $representante->documento=$request->cliente['empresa']['representante']['documento'];
                $representante->cargo=$request->cliente['empresa']['representante']['cargo'];
                $representante->fecha_nacimiento=$request->cliente['empresa']['representante']['fecha_nacimiento'];
                $representante->ocupacion=$request->cliente['empresa']['representante']['ocupacion'];
                $representante->telefono=$request->cliente['empresa']['representante']['telefono'];
                $representante->celular=$request->cliente['empresa']['representante']['celular'];
                $representante->ubicacion_direccion=$request->cliente['empresa']['representante']['ubicacion_direccion'];
                $representante->ubicacion_departamento=$request->cliente['empresa']['representante']['ubicacion_departamento'];
                $representante->ubicacion_provincia=$request->cliente['empresa']['representante']['ubicacion_provincia'];
                $representante->ubicacion_distrito=$request->cliente['empresa']['representante']['ubicacion_distrito'];
                $representante->ubicacion_referencia=$request->cliente['empresa']['representante']['ubicacion_referencia'];
                $representante->tipo_domicilio=$request->cliente['empresa']['representante']['tipo_domicilio'];
                $representante->poderes=$request->cliente['empresa']['representante']['poderes'];
                $representante->fecha_inicio=$request->cliente['empresa']['representante']['fecha_inicio'];
                $representante->estado_civil=$request->cliente['empresa']['representante']['estado_civil'];
                $representante->empresa_id=$empresa->id;
                $representante->save();
            }

            $prestamo->avales()->delete();
            foreach ($request->avales as $item) {
                $aval= new Aval;
                $aval->documento = $item['documento'];
                $aval->tipo_persona = $item['tipo_persona'];
                $aval->nombres = $item['nombres'];
                $aval->apellidos = $item['apellidos'];
                $aval->fecha_nacimiento = $item['fecha_nacimiento'];
                $aval->estado_civil = $item['estado_civil'];
                $aval->ocupacion = $item['ocupacion'];
                $aval->telefono = $item['telefono'];
                $aval->celular = $item['celular'];
                $aval->direccion = $item['direccion'];
                $aval->distrito = $item['distrito'];
                $aval->centro_laboral = $item['centro_laboral'];
                $aval->direccion_centro_laboral = $item['direccion_centro_laboral'];
                $aval->socio = $item['socio'];
                $aval->codigo_socio = $item['codigo_socio'];
                $aval->aporte_socio = $item['aporte_socio'];
                $aval->empresa_ruc = $item['empresa_ruc'];
                $aval->empresa_razon_social = $item['empresa_razon_social'];
                $aval->empresa_direccion = $item['empresa_direccion'];
                $aval->prestamo_id = $prestamo->id;
                $aval->save();
            }
            $prestamo->garantias()->delete();
            foreach ($request->garantias as $ep=>$garantias) {
                $garantia= new Garantia;
                $garantia->bien_garantia = $garantias['bien_garantia'];
                $garantia->inscripcion = $garantia['inscripcion'];
                $garantia->declaracion_jurada = $garantia['declaracion_jurada'];
                $garantia->prestamo_id = $prestamo->id;
                $garantia->save();
            }
    
            if($request->id==0){
                $subido= new Subido;
                $subido->prestamos_id=$prestamo->id;
                $subido->save();
    
                $subidos = Subido::find($subido->id);
                $subidos->solicitud_credito=1;
                $subidos->inscripcion_socio=1;
                $subidos->save();
            }
            DB::commit();

            return [
                'success' => true,
            ];

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
        $prestamoDatos= Prestamo::with('avales','garantias')->find($id);
        return $prestamoDatos;
        
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
