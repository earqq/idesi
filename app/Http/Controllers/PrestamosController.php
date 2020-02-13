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
use App\Evaluacion;
use App\RepresentanteLegal;
use App\Garantia;
use App\Archivo;
use App\Cuantitativa;
use App\ResultadoAnalisis;
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
        $prestamos=Prestamo::with('cliente.persona','cliente.empresa','evaluaciones')
        ->where(function($query) use($state){
            if($state!='TODOS'){
                $query->where('prestamos.estado',$state);
            }
        })
        ->where(function($query) use($text){
            if($text!=''){
                $text=strtoupper($text);
                $query->orWhere('cliente.persona.nombres', 'LIKE', "%{$text}%")
                ->orWhere('clientes.documento', 'LIKE', "%{$text}%")
                ->orWhere('cliente.persona.apellidos', 'LIKE', "%{$text}%")
                ->orWhere('cliente.empresa.razon_social', 'LIKE', "%{$text}%")
                ->orWhere('producto', 'LIKE', "%{$text}%");
            }
        })  
        ->where(function($query){
            if(Auth::user()->nivel == '3')
                $query->where('estado',2);
            else if(Auth::user()->nivel == '4')
                $query->where('user_id','=', Auth::user()->id);  
        })   
        ->where('estado','!=',1)
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
                if($request->cliente['persona']['conyuge'] && strlen($request->cliente['persona']['conyuge']['documento'])>5){
                    
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

                    if($request->cliente['persona']['conyuge']['trabaja']=='1'){
                        $conyugue->trabaja = true ;
                    }else{
                        $conyugue->trabaja = false ;
                    }

                    if($request->cliente['persona']['conyuge']['socio']=='1'){
                        $conyugue->socio = true ;
                    }else{
                        $conyugue->socio = false ;
                    }
                    
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
                $garantia->inscripcion = $garantias['inscripcion'];
                $garantia->declaracion_jurada = $garantias['declaracion_jurada'];
                $garantia->prestamo_id = $prestamo->id;
                $garantia->save();
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

    public function guardarFoto(Request $request){

        \Log::alert($request->all());
        $prestamo = Prestamo::with('cliente')->find($request->prestamo_id);
        $cliente=$prestamo->cliente;
        $nombre = $request->name;
        $extension = 'png';
        $file = $request->file;
        $file = str_replace('data:image/png;base64,', '', $file); 
        $data = base64_decode($file);

        if (!file_exists("storage/".$cliente->documento.'_'.$cliente->id."/prestamo_".$prestamo->id."/imagen")) {
            mkdir("storage/".$cliente->documento.'_'.$cliente->id."/prestamo_".$prestamo->id."/imagen", 0777, true);
        }

        if(file_put_contents("storage/".$cliente->documento.'_'.$cliente->id."/prestamo_".$prestamo->id."/imagen/".$request->name.".png", $data)){

                $pdf=PDF::loadView('reportes.imagen',compact('prestamo','cliente','nombre','extension'));
                Storage::put('public/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/imagenpdf/'.$request->name.'.pdf', $pdf->output());
                $archivo = new Archivo();
                $archivo->nombre= $request->name;
                $archivo->tipo='imagen'; 
                $archivo->extension= 'png';
                $archivo->prestamo_id=$request->prestamo_id;
                $archivo->save();
                \Log::alert("si entra");
                \Log::alert($request->all());
                $fotoNegocio = new FotoNegocio();
                $fotoNegocio->imagen= $archivo->id;
                $fotoNegocio->latitud= $request->latitud;
                $fotoNegocio->altitud=$request->longitud; 
                $fotoNegocio->prestamos_id=$request->prestamo_id;
                $fotoNegocio->save();
        }

        return [
            'success' => true,
            'data' => 'Cliente creado',
        ];
    }
    public function show($id)
    {
        $prestamo= Prestamo::with('avales','garantias','cliente.persona.hijos','resultadoAnalisis','evaluaciones','fotos')->find($id);
        return $prestamo;
    }
    public function enviarEvaluacion($prestamoID)
    {
        $prestamo = Prestamo::find($prestamoID);
        $prestamo->estado = 2;
        $prestamo->save();
    }
    public function evaluar(Request $request)
    {   
      
        if(Auth::user()->nivel==2){
            $prestamo=Prestamo::find($request->id);
            if($request->evaluacion['estado']==4 ){
                $prestamo->producto_final = 0;
                $prestamo->forma_final = 0;
                $prestamo->aporte_final = 0;
                $prestamo->importe_final = 0;
                $prestamo->plazo_final = 0;
                $prestamo->cuota_final = 0;
                $prestamo->tasa_final = 0;
                $prestamo->estado = $request->evaluacion['estado'];
                $prestamo->save();
            }else{
                $prestamo->producto_final = $request->evaluacion['producto'];
                $prestamo->aporte_final = $request->evaluacion['aporte'];
                $prestamo->importe_final = $request->evaluacion['importe'];
                $prestamo->plazo_final = $request->evaluacion['cuotas'];
                $prestamo->cuota_final = $request->evaluacion['cuota_sistema'];
                $prestamo->tasa_final = $request->evaluacion['tasa'];
                $prestamo->estado = $request->evaluacion['estado'];
                $prestamo->save();
            }
        }else{
            $evaluacion = new Evaluacion();
            $evaluacion->detalle  = $request->evaluacion['detalle'] ;
            $evaluacion->estado  = $request->evaluacion['estado'];
            $evaluacion->prestamo_id  = $request->id;
            $evaluacion->user_id  = Auth::user()->id;
            $evaluacion->save();        
        }
    } 





    public function evaluarFinal(Request $request)
    {
            try{

                   DB::beginTransaction();
                    
                   $prestamo = Prestamo::find($request['prestamos_id']);
                   
                   
    
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
}
