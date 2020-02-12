<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Cliente;
use App\Conyuge;
use App\Persona;
use App\Trabajo;
use App\Obligacion;
use App\Representante;
use App\Departamento;
use App\Hijo;
use App\Provincia;
use App\Declaracion;
use App\Distrito;
use Barryvdh\DomPDF\Facade as PDF;
use Auth;
use Illuminate\Support\Facades\Storage;
class PersonasController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $cliente = Cliente::where('documento', $request->documento)->first();
            if($cliente){
                DB::rollBack();
                return [
                    'success' => false,
                ];
            }
            else{
                $cliente = new Cliente();
                $cliente->user_id = Auth::user()->id;
                $cliente->tipo_documento = $request->tipo_documento;
                $cliente->documento = $request->documento;
                $cliente->tipo_cliente = $request->tipo_cliente;
                $cliente->pais = strtoupper($request->pais);
                $cliente->estado = 1;
                $cliente->ubicacion_referencia=strtoupper( $request->ubicacion_referencia);    
                $cliente->ubicacion_manzana=strtoupper( $request->ubicacion_manzana);    
                $cliente->ubicacion_numero= $request->ubicacion_numero;    
                $cliente->ubicacion_lote= $request->ubicacion_lote;    
                $cliente->ubicacion_nro_departamento= $request->ubicacion_nro_departamento;    
                $cliente->ubicacion_interior= $request->ubicacion_interior;    
                $cliente->ubicacion_piso= $request->ubicacion_piso;    
                $cliente->ubicacion_distrito=strtoupper( $request->ubicacion_distrito);    
                $cliente->ubicacion_provincia=strtoupper( $request->ubicacion_provincia);    
                $cliente->ubicacion_departamento=strtoupper( $request->ubicacion_departamento);    
                $cliente->email=strtoupper( $request->email);    
                $cliente->telefono=strtoupper( $request->telefono);    
                $cliente->celular=strtoupper( $request->celular);    
                $cliente->ubicacion_direccion_declarada=strtoupper( $request->ubicacion_direccion_declarada);    
                $cliente->ubicacion_direccion_sistema=strtoupper( $request->ubicacion_direccion_sistema);    
                $cliente->save();
                
                $persona = new Persona();

                $persona->tipo_domicilio=strtoupper( $request->persona['tipo_domicilio']);    

                $persona->cliente_id= $cliente->id;
                $persona->nombres= strtoupper($request->persona['nombres']);    
                $persona->apellidos=strtoupper( $request->persona['apellidos']);    
                $persona->fecha_nacimiento=strtoupper( $request->persona['fecha_nacimiento']);    
                $persona->estado_civil=strtoupper( $request->persona['estado_civil']);    
                $persona->ocupacion=strtoupper( $request->persona['ocupacion']);    
                $persona->nacimiento_departamento = strtoupper($request->persona['nacimiento_departamento']);
                $persona->nacimiento_provincia = strtoupper($request->persona['nacimiento_provincia']);
                $persona->nacimiento_distrito = strtoupper($request->persona['nacimiento_distrito']);
                $persona->genero=strtoupper( $request->persona['genero']);    
                $persona->grado_instruccion=strtoupper( $request->persona['grado_instruccion']);    
                $persona->estado_trabajo = $request->persona['estado_trabajo'];   
                $persona->trabajo_especificacion= $request->persona['trabajo_especificacion'];   
                $persona->save();

                $departamento_domicilio = Departamento::where('id',$cliente->ubicacion_departamento)->first();
                $provincia_domicilio = Provincia::where('id',$cliente->ubicacion_provincia)->first();
                $distrito_domicilio = Distrito::where('id',$cliente->ubicacion_distrito)->first();
 
                $trabajo='';
                if($persona->estado_trabajo=='TRABAJA'){

                    $trabajo = new Trabajo();
                    $trabajo->estado_laboral = $request->persona['estado_trabajo'];
                    $trabajo->especificacion = $request->persona['trabajo_especificacion'];     
                    $trabajo->tipo_trabajador= $request->trabajo['tipo_trabajador'];    
                    $trabajo->ingreso_mensual= $request->trabajo['ingreso_mensual'];  
                    $trabajo->cargo_ocupacion= $request->trabajo['cargo_ocupacion'];    
                    $trabajo->fecha_ingreso= $request->trabajo['fecha_ingreso'];    
                    $trabajo->empresa_razon_social= $request->trabajo['empresa_razon_social'];    
                    $trabajo->empresa_giro_negocio= $request->trabajo['empresa_giro_negocio'];    
                    $trabajo->empresa_direccion = $request->trabajo['empresa_direccion'];            
                    $trabajo->empresa_numero = $request->trabajo['empresa_numero'];    
                    $trabajo->empresa_manzana = $request->trabajo['empresa_manzana'];    
                    $trabajo->empresa_lote = $request->trabajo['empresa_lote'];    
                    $trabajo->empresa_dpto = $request->trabajo['empresa_dpto'];    
                    $trabajo->empresa_int = $request->trabajo['empresa_int'];    
                    $trabajo->empresa_piso = $request->trabajo['empresa_piso'];    
                    $trabajo->empresa_distrito = $request->trabajo['empresa_distrito'];    
                    $trabajo->empresa_provincia = $request->trabajo['empresa_provincia'];    
                    $trabajo->empresa_departamento = $request->trabajo['empresa_departamento'];    
                    $trabajo->empresa_pais = $request->trabajo['empresa_pais'];    
                    $trabajo->empresa_referencia = $request->trabajo['empresa_referencia'];    
                    $trabajo->empresa_telefono = $request->trabajo['empresa_telefono'];    
                    $trabajo->empresa_celular = $request->trabajo['empresa_celular'];    
                    $trabajo->empresa_email = $request->trabajo['empresa_email'];    
                    $trabajo->persona_id = $persona->id;    
                    $trabajo->save();
                }

                foreach ($request->persona["hijos"] as $hijo) {
                    $parienteDetalle= new Hijo;
                    $parienteDetalle->nombres = $hijo['nombres'];
                    $parienteDetalle->documento = $hijo['documento'];
                    $parienteDetalle->fecha_nacimiento = $hijo['fecha_nacimiento'];
                    $parienteDetalle->socio = $hijo['socio'];
                    $parienteDetalle->persona_id= $persona->id;
                    $parienteDetalle->save();
                }

                $hijos = Hijo::where('persona_id',$persona->id)->get();
                
                if($request->tools["conyuge"])
                {
                    
                    $conyuge= new Conyuge;
                    $conyuge->nombres= $request->persona['conyuge']['nombres'];
                    $conyuge->documento= $request->persona['conyuge']['documento'];
                    $conyuge->ocupacion= $request->persona['conyuge']['ocupacion'];
                    $conyuge->fecha_nacimiento = $request->persona['conyuge']['fecha_nacimiento'];
                    if($request->persona['conyuge']['socio']==1){
                        $conyuge->socio = true; 
                    }else{
                        $conyuge->socio = false; 
                    }
                    $conyuge->estado_civil = 'CONVIVIENTE';
                    $conyuge->persona_id = $persona->id;   
                    $conyuge->save();
                }

                $conyuge = Conyuge::where('persona_id',$persona->id)->first();

                if($request->persona["representante"]['documento']!=''){
                    $representante = New Representante;
                    $representante->nombres= $request->persona["representante"]['nombres'];    
                    $representante->tipo_documento= $request->persona["representante"]['tipo_documento'];    
                    $representante->documento= $request->persona["representante"]['documento'];    
                    $representante->relacion= $request->persona["representante"]['tipo_relacion'];    
                    $representante->persona_id= $persona->id; 
                    $representante->save();
                }

                $representante = Representante::where('persona_id', $persona->id)->first();

                $obligacion = New Obligacion;
                $obligacion->inscripcion= $request->obligacion['inscripcion'];    
                $obligacion->aporte= $request->obligacion['aporte'];    
                $obligacion->fondo= $request->obligacion['fondo'];    
                $obligacion->fondo_opcional= $request->obligacion['fondo_opcional'];    
                $obligacion->cliente_id= $cliente->id; 
                $obligacion->save();

                $declaracion = New Declaracion;
                $declaracion->uif= $request->declaracion['uif'];    
                $declaracion->pep= $request->declaracion['pep'];    
                $declaracion->observaciones= $request->declaracion['obervaciones'];    
                $declaracion->cliente_id= $cliente->id; 
                $declaracion->save(); 

                $pdf = PDF::loadView('reportes.inscripcion',compact('trabajo','representante','obligacion','declaracion','cliente',
                                                                    'hijos','conyuge','persona',
                                                                    'departamento_domicilio','provincia_domicilio','distrito_domicilio'));

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
