<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Prestamo;
use App\Departamento;
use App\Distrito;
use App\Aval;
use App\Archivo;
use App\Garantia;
use App\Provincia;
use App\Conyugue;
use App\Natural;
use App\Laboral;
use App\Juridico;
use App\Subido;
use App\Vista;
use App\Detalle;
use App\Adicional;
use App\ResultadoCuantitativa;
use App\AsociativaNatural;
use App\Asociativa;
use App\Familiar;
use App\Declaracion;
use App\DeclaracionJuridico;
use App\Director;
use App\Accionista;
use App\Representante;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if(!$request->ajax()) return redirect('/clientes');
        // $pretamos = Prestamo::join('clientes','prestamos.clientes_id',"=","clientes.id")
        // ->select('clientes.nombres','clientes.apellidos','prestamos.estado','prestamos.id')->get();

        if(Auth::user()->id == '1'){



            $clientes = Cliente::join('naturals','clientes.id','=','naturals.clientes_id')
              ->select('clientes.documento','naturals.nombres','naturals.apellidos')
              ->where('clientes.documento', 'LIKE', "%{$request->search_input}%")
              ->orWhere('naturals.nombres', 'LIKE', "%{$request->search_input}%")
              ->orWhere('naturals.apellidos', 'LIKE', "%{$request->search_input}%")
              ->orderBy('clientes.id','desc')
              ->paginate(10);
            return $clientes;

        }
        else{
            $clientes = Cliente::join('naturals','clientes.id','=','naturals.clientes_id')
              ->select('clientes.documento','naturals.nombres','naturals.apellidos')
              ->orderBy('clientes.id','desc')
              ->where('users_id','=',Auth::user()->id)
              ->paginate(10);
            return $clientes;
        }

    }


    public function indexJuridico(Request $request)
    {
        if(Auth::user()->id == '1'){


            $clientes = Cliente::join('juridicos','clientes.id','=','juridicos.clientes_id')
              ->select('clientes.documento', 'juridicos.razon_social')
              ->where('juridicos.razon_social', 'LIKE', "%{$request->search_input}%")
              ->orWhere('clientes.documento', 'LIKE', "%{$request->search_input}%")
              ->orderBy('clientes.id','desc')
              ->paginate(10);
            return $clientes;

        }
        else{
            $clientes = Cliente::join('juridicos','clientes.id','=','juridicos.clientes_id')
              ->select('clientes.documento','juridicos.razon_social')
              ->orderBy('clientes.id','desc')
              ->where('users_id','=',Auth::user()->id)
              ->paginate(10);
            return $clientes;
        }

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

    public function storeNatural(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        // return $request->input('distritos_id');

        try{

            DB::beginTransaction();

            // return $request;
            $cliente = Cliente::where('documento',$request->input('documento'))->first();
            if($cliente){
                DB::rollBack();
                return [
                    'success' => false,
                    'data' => 'Cliente ya existe'
                ];
            }
            else{
                $cliente = new Cliente();
                $cliente->users_id = Auth::user()->id;
                $cliente->tipo_documento = $request->cliente['tipo_documento'];
                $cliente->documento = $request->cliente['documento'];
                $cliente->codigo = $request->cliente['codigo'];
                $cliente->tipo_cliente = $request->cliente['tipo_cliente'];
                $cliente->pais = $request->cliente['pais'];
                $cliente->departamento = $request->cliente['departamento'];
                $cliente->provincia = $request->cliente['provincia'];
                $cliente->distrito = $request->cliente['distrito'];
                $cliente->numero_registro = $request->cliente['numero_registro'];
                $cliente->agencia = $request->cliente['agencia'];
                $cliente->save();
                
                $natural = new Natural();
                $natural->clientes_id= $cliente->id;
                $natural->nombres= $request->natural['nombres'];    
                $natural->apellidos= $request->natural['apellidos'];    
                $natural->nacimiento= $request->natural['nacimiento'];    
                $natural->estado_civil= $request->natural['estado_civil'];    
                $natural->ocupacion= $request->natural['ocupacion'];    
                $natural->telefono= $request->natural['telefono'];    
                $natural->celular= $request->natural['celular'];    
                $natural->direccion_cliente= $request->natural['direccion'];    
                $natural->direccion_registros= $request->natural['direccion_registros'];    
                $natural->referencia= $request->natural['referencia'];    
                $natural->tipo_domicilio= $request->natural['tipo_domicilio'];    
                $natural->centro_laboral= $request->laboral['razon_social'];    
                $natural->direccion_laboral= $request->laboral['direccion'];    
                $natural->genero= $request->natural['genero'];    
                $natural->grado_instruccion= $request->natural['grado_instruccion'];    
                $natural->numero= $request->natural['numero'];    
                $natural->manzana= $request->natural['manzana'];    
                $natural->lote= $request->natural['lote'];    
                $natural->dpto= $request->natural['dpto'];    
                $natural->int= $request->natural['int'];    
                $natural->piso= $request->natural['piso'];    
                $natural->domicilio_distrito= $request->natural['domicilio_distrito'];    
                $natural->domicilio_provincia= $request->natural['domicilio_provincia'];    
                $natural->domicilio_departamento= $request->natural['domicilio_departamento'];    
                $natural->correo= $request->natural['correo'];    
                
                $natural->save();

                $laboral = new Laboral();
                $laboral->estado_laboral= $request->laboral['estado_laboral'];    
                $laboral->tipo_trabajador= $request->laboral['tipo_trabajador'];    
                $laboral->razon_social= $request->laboral['razon_social'];    
                $laboral->ingreso_mensual= $request->laboral['ingreso_mensual'];  
                if($request->laboral['estado_laboral']=='OTROS'){
                     $laboral->especificacion= $request->laboral['especificacion'];
                }
                else
                {
                    $laboral->especificacion= $request->laboral['estado_laboral'];
                }
                $laboral->cargo_ocupacion= $request->laboral['cargo_ocupacion'];    
                $laboral->fecha_ingreso= $request->laboral['fecha_ingreso'];    
                $laboral->giro_negocio= $request->laboral['giro_negocio'];    
                $laboral->direccion= $request->laboral['direccion'];            
                $laboral->numero= $request->laboral['numero'];    
                $laboral->manzana= $request->laboral['manzana'];    
                $laboral->lote= $request->laboral['lote'];    
                $laboral->dpto= $request->laboral['dpto'];    
                $laboral->int= $request->laboral['int'];    
                $laboral->piso= $request->laboral['piso'];    
                $laboral->distrito= $request->laboral['distrito'];    
                $laboral->provincia= $request->laboral['provincia'];    
                $laboral->departamento= $request->laboral['departamento'];    
                $laboral->pais= $request->laboral['pais'];    
                $laboral->referencia= $request->laboral['referencia'];    
                $laboral->telefono= $request->laboral['telefono'];    
                $laboral->celular= $request->laboral['celular'];    
                $laboral->email= $request->laboral['email'];    
                $laboral->naturals_id= $natural->id;    
                $laboral->save();

                $familiar = New Familiar;
                $familiar->hijos= $request->familia['hijos'];
                $familiar->numero= $request->familia['numero'];    
                $familiar->conyugue= $request->familia['conyugue'];  
                $familiar->ocupacion= $request->familia['ocupacion'];    
                $familiar->naturals_id= $natural->id; 
                $familiar->save();

                foreach ($request->detalles as $ep=>$rp) {
                    $detalle= new Detalle;
                    $detalle->nombres = $rp['nombres'];
                    $detalle->documento = $rp['documento'];
                    $detalle->parentesco = $rp['parentesco'];
                    $detalle->nacimiento = $rp['nacimiento'];
                    $detalle->socio = $rp['socio'];
                    $detalle->familiars_id= $familiar->id;
                    $detalle->save();

                    if($rp['parentesco']=='CONYUGE')
                    {
                        $conyuge= new Conyugue;
                        $conyuge->nombres= $rp['nombres'];
                        $conyuge->documento= $rp['documento'];
                        $conyuge->nacimiento = $rp['nacimiento'];
                        $conyuge->socio = $rp['socio'];
                        $conyuge->naturals_id = $natural->id;   
                        $conyuge->save();
                    }
                }

                $detallesfam= Detalle::where('familiars_id',$familiar->id)->get();


                $adicional = New Adicional;
                $adicional->representante= $request->adicional['representante'];    
                $adicional->documento= $request->adicional['documento'];    
                $adicional->numero= $request->adicional['numero'];    
                $adicional->relacion= $request->adicional['relacion'];    
                $adicional->naturals_id= $natural->id; 
                $adicional->save();

                $asociativa = New AsociativaNatural;
                $asociativa->inscripcion= $request->asociativa['inscripcion'];    
                $asociativa->aporte= $request->asociativa['aporte'];    
                $asociativa->fondo= $request->asociativa['fondo'];    
                $asociativa->fondo_opcional= $request->asociativa['fondo_opcional'];    
                $asociativa->naturals_id= $natural->id; 
                $asociativa->save();

                $declaracion = New Declaracion;
                $declaracion->uif= $request->declaracion['uif'];    
                $declaracion->pep= $request->declaracion['pep'];    
                $declaracion->observaciones= $request->declaracion['obervaciones'];    
                $declaracion->estado= $request->declaracion['estado'];    
                $declaracion->naturals_id= $natural->id; 
                $declaracion->save();

                $pdf = PDF::loadView('reportes.inscripcion',compact('laboral','adicional','asociativa','declaracion','familiar','cliente','detallesfam','natural'));

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

    public function storeJuridico(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        // return $request->input('distritos_id');

        try{

            DB::beginTransaction();

            
            // $cliente = Cliente::where('documento',$request->input('documento'))->first();
            // if($cliente){
            //     DB::rollBack();
            //     return [
            //         'success' => false,
            //         'data' => 'Cliente ya existe'
            //     ];
            // }
            // else{
                
                $cliente = new Cliente();
                $cliente->tipo_documento ='RUC';
                $cliente->users_id = Auth::user()->id;
                $cliente->documento = $request->cliente['documento'];
                $cliente->codigo = $request->cliente['codigo'];
                $cliente->tipo_cliente = $request->cliente['tipo_cliente'];
                $cliente->pais = $request->cliente['pais'];
                $cliente->departamento = $request->cliente['departamento'];
                $cliente->provincia = $request->cliente['provincia'];
                $cliente->distrito = $request->cliente['distrito'];
                $cliente->numero_registro = $request->cliente['numero_registro'];
                $cliente->agencia = $request->cliente['agencia'];
                $cliente->save();
                
                $juridico = new Juridico();
                $juridico->razon_social= $request->juridico['razon_social'];    
                $juridico->nombre_comercial= $request->juridico['nombre_comercial'];    
                $juridico->actividad_principal= $request->juridico['actividad_principal'];    
                $juridico->partida_registral= $request->juridico['partida_registral'];    
                $juridico->oficina_principal= $request->juridico['oficina_principal'];    
                $juridico->tipo_negocio= $request->juridico['tipo_negocio'];    
                $juridico->direccion= $request->juridico['direccion'];    
                $juridico->numero= $request->juridico['numero'];    
                $juridico->manzana= $request->juridico['manzana'];    
                $juridico->lote= $request->juridico['lote'];    
                $juridico->pdto= $request->juridico['pdto'];
                $juridico->int= $request->juridico['int'];
                $juridico->piso= $request->juridico['piso'];
                $juridico->telefono= $request->juridico['telefono'];
                $juridico->celular= $request->juridico['celular'];
                $juridico->email= $request->juridico['email'];
                $juridico->referencia= $request->juridico['referencia'];
                $juridico->clientes_id= $cliente->id;
                $juridico->save();

                foreach ($request->representante as $ep=>$rp) { 

                    $representante= new Representante;
                    $representante->nombres = $rp['nombres'];
                    $representante->documento = $rp['documento'];
                    $representante->cargo = $rp['cargo'];
                    $representante->juridicos_id= $juridico->id;
                    $representante->save();

                    if($representante->id==1){
                        $jur_rep = Juridico::find($representante->juridicos_id);
                        $jur_rep->documento_representante = $rp['documento'];
                        $jur_rep->nombres_representante = $rp['nombres'] ;
                        $jur_rep->save();
                    }
                    
                }
                
                $listaRepresentante= Representante::where('juridicos_id',$juridico->id)->get();
                $tiene_representantes = '';

                if($listaRepresentante){
                    $tiene_representantes='SI'; 
                }
                else{
                    $tiene_representantes='NO';
                }  

                foreach ($request->director as $ep=>$dr) {
                   $director= new Director;
                   $director->nombres = $dr['nombres'];
                   $director->documento = $dr['documento'];
                   $director->cargo = $dr['cargo'];
                   $director->juridicos_id= $juridico->id;
                   $director->save();
                }

                $listaDirector= Director::where('juridicos_id',$juridico->id)->get();
                $tiene_directores = '';

                if($listaDirector){
                    $tiene_directores='SI'; 
                }
                else{
                    $tiene_directores='NO';
                }  

                foreach ($request->accionista as $ep=>$ac) {
                   $accionista= new Accionista;
                   $accionista->nombres = $ac['nombres'];
                   $accionista->documento = $ac['documento'];
                   $accionista->juridicos_id= $juridico->id;
                   $accionista->save();
                }
                $listaAccionista= Accionista::where('juridicos_id',$juridico->id)->get();
                $tiene_accionistas = '';

                if($listaAccionista){
                    $tiene_accionistas='SI'; 
                }
                else{
                    $tiene_accionistas='NO';
                }  

                $asociativa = New Asociativa;
                $asociativa->inscripcion= $request->asociativa['inscripcion'];    
                $asociativa->aporte= $request->asociativa['aporte'];    
                $asociativa->juridicos_id= $juridico->id;
                $asociativa->save();

                $declaracion = New DeclaracionJuridico;
                $declaracion->uif= $request->declaracion['uif'];    
                $declaracion->observaciones= $request->declaracion['observaciones'];    
                $declaracion->estado= $request->declaracion['estado'];    
                $declaracion->juridicos_id= $juridico->id;
                $declaracion->save();
                
                $pdf = PDF::loadView('reportes.inscripcionJuridico',compact('cliente','juridico','asociativa','declaracion','listaAccionista','tiene_accionistas','listaDirector','tiene_directores','listaRepresentante','tiene_representantes'));

                if (Storage::put('public/'.$cliente->documento.'_'.$cliente->id.'/general/documento/inscripcion_de_socio.pdf', $pdf->output())){
                }
            DB::commit();
                return [
                    'success' => true,
                    'data' => 'Cliente creado',
                ];
    
            // }
 

        } catch (Exception $e){
            return [
                'success' => false,
            ];
            DB::rollBack();
        }
       
    }

    public function visitaStore(Request $request)
    {


        return $request;
        if (!$request->ajax()) return redirect('/');
 

        $visita = new Vista();
        $visita->fecha=$request->fecha;
        $visita->hora=$request->hora;
        $visita->motivo=$request->motivo;
        $visita->latitud= $request->center['lat'];
        $visita->altitud=$request->center['lng'];
        $visita->estado=$request->estado;
        $visita->prestamos_id=$request->prestamos_id;

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


    public function showCliente($documento)
    {
        // $cliente = Cliente::where('documento',$documento)
        // ->select('id','documento','nombres','apellidos','nacimiento')
        // ->first();

        $clientes = Cliente::where('documento',$documento)
                             ->join('naturals','clientes.id','=','naturals.clientes_id')
                             ->select('clientes.id AS idcliente','clientes.documento','naturals.id','naturals.nombres','naturals.direccion_cliente','naturals.celular','naturals.apellidos','naturals.nacimiento')
                             ->first();

        $prestamos = Prestamo::where('clientes_id',"=",$clientes->idcliente)->get();

        // return 'cliente'=>$clientes;
        return ['cliente'=>$clientes, 'prestamos'=>$prestamos];
        
    }

    public function showClienteJuridico($documento)
    {

        $clientes = Cliente::where('documento',$documento)
                             ->join('juridicos','clientes.id','=','juridicos.clientes_id')
                             ->select('clientes.id AS idcliente','clientes.documento','juridicos.id','juridicos.razon_social','juridicos.partida_registral','juridicos.celular','juridicos.direccion')
                             ->first();

        $prestamos = Prestamo::where('clientes_id',"=",$clientes->idcliente)->get();

        // return 'cliente'=>$clientes;
        return ['cliente'=>$clientes, 'prestamos'=>$prestamos];
        
    }
 
    public function visitas($documento)
    {
        // if (!$request->ajax()) return redirect('/');
        $vistas = Vista::where('prestamos_id',$documento)->get();

        return $vistas;
        
    }

    public function general($documento)
    {

        $cliente = Cliente::where('documento',$documento)->first();
        $natural = Natural::where('clientes_id',$cliente->id)->first();
        $conyugue = Conyugue::where('naturals_id',$natural->id)->first();
        $tiene_conyuge = '';
        if($conyugue){
            $tiene_conyuge='SI'; 
        }
        else{
            $tiene_conyuge='NO';
        }     
        return compact('cliente','natural','conyugue','tiene_conyuge');
    }

    public function generalJuridico($documento)
    {

        $cliente = Cliente::where('documento',$documento)->first();

        $juridico = Juridico::where('clientes_id',$cliente->id)->first();


        return compact('cliente','juridico');
    }

    public function prestamo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{

            DB::beginTransaction();
            
            $cliente = Cliente::where('documento',$request->cliente['documento'])->first();
            // $cliente->departamentos_id = $request->cliente['departamentos_id'];
            // $cliente->distritos_id= $request->cliente['distritos_id'];
            // $cliente->provincias_id = $request->cliente['provincias_id'];
            $cliente->save();

            $natural = Natural::where('clientes_id',$cliente->id)->first();
            $natural->celular = $request->natural['celular'];
            $natural->nombres = $request->natural['nombres'];
            $natural->apellidos = $request->natural['apellidos'];
            $natural->centro_laboral = $request->natural['centro_laboral'];
            $natural->direccion_cliente = $request->natural['direccion'];
            $natural->direccion_laboral = $request->natural['direccion_laboral'];
            $natural->estado_civil = $request->natural['estado_civil'];
            $natural->nacimiento = $request->natural['nacimiento'];
            $natural->ocupacion = $request->natural['ocupacion'];
            $natural->referencia = $request->natural['referencia'];
            $natural->telefono = $request->natural['telefono'];
            $natural->tipo_domicilio =  $request->natural['tipo_domicilio'];
            $natural->save();
            
            if($request->conyugue['conyuge_tiene']=='SI'){
                $conyugue = Conyugue::where('naturals_id',$natural->id)->first();
                if(!$conyugue){
                    $conyugue = new Conyugue;
                   }
                   $conyugue->centro_laboral= $request->conyugue['centro_laboral_conyugue'];
                   $conyugue->direccion = $request->conyugue['direccion_laboral_conyugue'] ;
                   $conyugue->documento = $request->conyugue['documento_conyugue'] ;
                   $conyugue->estado_civil =  $request->conyugue['estado_civil_conyugue'] ;
                   $conyugue->nacimiento =  $request->conyugue['nacimiento_conyugue'];
                   $conyugue->nombres =  $request->conyugue['nombres_conyugue'];
                   $conyugue->ocupacion =  $request->conyugue['ocupacion_conyugue'];
                   $conyugue->telefono =  $request->conyugue['telefono_conyugue'] ;
                   $conyugue->celular =  $request->conyugue['celular_conyugue'];
                   $conyugue->socio =  $request->conyugue['socio_conyugue'];
                   $conyugue->codigo_socio =  $request->conyugue['codigo_socio_conyugue'];
                   $conyugue->aporte_socio =  $request->conyugue['aporte_socio_conyugue'];
                   $conyugue->naturals_id = $natural->id;   
                   $conyugue->save();
            }

            
            if($request->input('idprestamo')<0){
               $prestamo = new Prestamo();
               $prestamo->cualitativa = 0;
               $prestamo->cuantitativa = 0;
            }
            else{
                $prestamo = Prestamo::where('id',$request->input('idprestamo'))->first();
            }

            $prestamo->clientes_id = $cliente->id;
            $prestamo->users_id = Auth::user()->id;
            $prestamo->monto_inicial = $request->input('monto_inicial');
            $prestamo->plazo_inicial = $request->input('plazo_inicial');
            $prestamo->disponibilidad_pago_inicial = $request->input('disponibilidad_pago_inicial');
            $prestamo->destino_inicial = $request->input('destino_inicial');
            $prestamo->forma_inicial = $request->input('forma_inicial');
            $prestamo->meses = $request->input('meses');
            $prestamo->producto = $request->input('producto');
            $prestamo->forma = $request->input('forma');
            $prestamo->importe = $request->input('importe');
            $prestamo->aporte = $request->input('aporte');
            $prestamo->probabilidad_infocorp = $request->input('probabilidad_infocorp');
            $prestamo->plazo = $request->input('plazo');
            $prestamo->cuotas = $request->input('cuotas');
            $prestamo->tasa = $request->input('tasa');
            $prestamo->comentarios = $request->input('comentarios');
            $prestamo->estado = $request->input('estado');
            
            $prestamo->save();

            if($request->input('idprestamo')<0){
                foreach ($request->avals as $ep=>$avals) {
                    $aval= new Aval;
                    $aval->documento = $avals['documento'];
                    $aval->tipo_persona = $avals['tipo_persona'];
                    $aval->nombres = $avals['nombres'];
                    $aval->apellidos = $avals['apellidos'];
                    $aval->nacimiento = $avals['nacimiento'];
                    $aval->estado_civil = $avals['estado_civil'];
                    $aval->ocupacion = $avals['ocupacion'];
                    $aval->telefono = $avals['telefono'];
                    $aval->celular = $avals['celular'];
                    $aval->direccion = $avals['direccion'];
                    $aval->distrito = $avals['distrito'];
                    $aval->centro_laboral = $avals['centro_laboral'];
                    $aval->direccion_laboral = $avals['direccion_laboral'];
                    $aval->socio = $avals['socio'];
                    $aval->codigo_socio = $avals['codigo_socio'];
                    $aval->aporte_socio = $avals['aporte_socio'];
                    $aval->prestamos_id = $prestamo->id;
                    $aval->save();
                }
    
                foreach ($request->garantias as $ep=>$garantias) {
                    $garantia= new Garantia;
                    $garantia->bien_garantia = $garantias['bien_garantia'];
                    if($garantias['tipo']=='INS'){
                        $garantia->inscripcion = 'SI';
                        $garantia->tipo = $garantias['tipo'];
                    }else{
                        $garantia->declaracion_jurada = 'SI';
                        $garantia->tipo = $garantias['tipo'];
                    }
    
                    $garantia->prestamos_id = $prestamo->id;
                    $garantia->save();
                }
    
    
                $subido= new Subido;
                $subido->prestamos_id=$prestamo->id;
                $subido->save();
    
                $subidos = Subido::find($subido->id);
                $subidos->solicitud_credito=1;
                $subidos->inscripcion_socio=1;
                $subidos->save();
            }

            // $cuantitativa = new ResultadoCuantitativa;
            // $cuantitativa->prestamo_id= $prestamo->id;
            // $cuantitativa->save();




            // $prestamos= Prestamo::find($prestamo->id);
            // $cliente = Cliente::where('id',$prestamos->clientes_id)->first();
            // $avals = Aval::where('prestamos_id',$prestamos->id)->get();
            // $garantias = Garantia::where('prestamos_id',$prestamos->id)->get();

            // // return $cliente;
            // $pdf = PDF::loadView('reportes.prestamo',compact('prestamos','cliente','avals','garantias'));

            // if (Storage::put('public/'.$this->getUserDir($prestamos->id) .'/prestamo_'.$prestamo->id.'/documento/prestamo_'.$prestamo->id.'.pdf', $pdf->output())) {
            //     $file= new Archivo;
            //     $file->nombre = 'prestamo_'.$prestamo->id;
            //     $file->tipo = 'documento';
            //     $file->extension = 'pdf';
            //     $file->prestamos_id =  $prestamos->id;
            //     $file->save();
            // }
    
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

    public function prestamoJuridico(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{

            DB::beginTransaction();
            
            $cliente = Cliente::where('documento',$request->cliente['documento'])->first();
            // $cliente->departamentos_id = $request->cliente['departamentos_id'];
            // $cliente->distritos_id= $request->cliente['distritos_id'];
            // $cliente->provincias_id = $request->cliente['provincias_id'];
            $cliente->save();

  

            $juridico = Juridico::where('clientes_id',$cliente->id)->first();
            $juridico->razon_social = $request->juridico['razon_social'];
            $juridico->nombre_comercial = $request->juridico['nombre_comercial'];
            $juridico->actividad_principal = $request->juridico['actividad_principal'];
            $juridico->partida_registral = $request->juridico['partida_registral'];
            $juridico->telefono = $request->juridico['telefono'];
            $juridico->direccion = $request->juridico['direccion'];
            $juridico->email = $request->juridico['email'];

            $juridico->nombres_representante = $request->representante['nombres_representante'];
            $juridico->documento_representante = $request->representante['documento_representante'];
            $juridico->nacimiento_representante = $request->representante['nacimiento_representante'];
            $juridico->estado_civil_representante = $request->representante['estado_civil_representante'];
            $juridico->ocupacion_representante = $request->representante['ocupacion_representante'];
            $juridico->telefono_representante = $request->representante['telefono_representante'];
            $juridico->celular_representante = $request->representante['celular_representante'];
            $juridico->direccion_representante = $request->representante['direccion_representante'];
            $juridico->distrito_representante = $request->representante['distrito_representante'];
            $juridico->provincia_representante = $request->representante['provincia_representante'];
            $juridico->departamento_representante = $request->representante['departamento_representante'];
            $juridico->referencia_representante = $request->representante['referencia_representante'];
            $juridico->tipo_domicilio_representante = $request->representante['tipo_domicilio_representante'];
            $juridico->poderes_representante = $request->representante['poderes_representante'];
            $juridico->fecha_inicio_representante = $request->representante['fecha_inicio_representante'];
            $juridico->save();


            if($request->input('idprestamo')<0){
               $prestamo = new Prestamo();
               $prestamo->cualitativa = 0;
               $prestamo->cuantitativa = 0;
            }
            else{
                $prestamo = Prestamo::where('id',$request->input('idprestamo'))->first();
            }
            $prestamo->clientes_id = $cliente->id;
            $prestamo->users_id = Auth::user()->id;
            $prestamo->monto_inicial = $request->input('monto_inicial');
            $prestamo->plazo_inicial = $request->input('plazo_inicial');
            $prestamo->disponibilidad_pago_inicial = $request->input('disponibilidad_pago_inicial');
            $prestamo->destino_inicial = $request->input('destino_inicial');
            $prestamo->forma_inicial = $request->input('forma_inicial');
            $prestamo->meses = $request->input('meses');
            $prestamo->producto = $request->input('producto');
            $prestamo->forma = $request->input('forma');
            $prestamo->importe = $request->input('importe');
            $prestamo->aporte = $request->input('aporte');
            $prestamo->probabilidad_infocorp = $request->input('probabilidad_infocorp');
            $prestamo->plazo = $request->input('plazo');
            $prestamo->cuotas = $request->input('cuotas');
            $prestamo->tasa = $request->input('tasa');
            $prestamo->comentarios = $request->input('comentarios');
            $prestamo->estado = $request->input('estado');
            $prestamo->save();

            foreach ($request->avals as $ep=>$avals) {
                $aval= new Aval;
                $aval->documento = $avals['documento'];
                $aval->tipo_persona = $avals['tipo_persona'];
                $aval->nombres = $avals['nombres'];
                $aval->apellidos = $avals['apellidos'];
                $aval->nacimiento = $avals['nacimiento'];
                $aval->estado_civil = $avals['estado_civil'];
                $aval->ocupacion = $avals['ocupacion'];
                $aval->telefono = $avals['telefono'];
                $aval->celular = $avals['celular'];
                $aval->direccion = $avals['direccion'];
                $aval->distrito = $avals['distrito'];
                $aval->centro_laboral = $avals['centro_laboral'];
                $aval->direccion_laboral = $avals['direccion_laboral'];
                $aval->socio = $avals['socio'];
                $aval->codigo_socio = $avals['codigo_socio'];
                $aval->aporte_socio = $avals['aporte_socio'];
                $aval->prestamos_id = $prestamo->id;
                $aval->save();
            }

            foreach ($request->garantias as $ep=>$garantias) {
                $garantia= new Garantia;
                $garantia->bien_garantia = $garantias['bien_garantia'];
                if($garantias['tipo']=='INS'){
                    $garantia->inscripcion = 'SI';
                }else{
                    $garantia->declaracion_jurada = 'SI';
                }

                $garantia->prestamos_id = $prestamo->id;
                $garantia->save();
            }


            $subido= new Subido;
            $subido->prestamos_id=$prestamo->id;
            $subido->save();

            $subidos = Subido::find($subido->id);
            $subidos->solicitud_credito=1;
            $subidos->inscripcion_socio=1;
            $subidos->save();

            // $cuantitativa = new ResultadoCuantitativa;
            // $cuantitativa->prestamo_id= $prestamo->id;
            // $cuantitativa->save();




            // $prestamos= Prestamo::find($prestamo->id);
            // $cliente = Cliente::where('id',$prestamos->clientes_id)->first();
            // $avals = Aval::where('prestamos_id',$prestamos->id)->get();
            // $garantias = Garantia::where('prestamos_id',$prestamos->id)->get();

            // // return $cliente;
            // $pdf = PDF::loadView('reportes.prestamo',compact('prestamos','cliente','avals','garantias'));

            // if (Storage::put('public/'.$this->getUserDir($prestamos->id) .'/prestamo_'.$prestamo->id.'/documento/prestamo_'.$prestamo->id.'.pdf', $pdf->output())) {
            //     $file= new Archivo;
            //     $file->nombre = 'prestamo_'.$prestamo->id;
            //     $file->tipo = 'documento';
            //     $file->extension = 'pdf';
            //     $file->prestamos_id =  $prestamos->id;
            //     $file->save();
            // }
    
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
        $natural = Natural::where('clientes_id',$cliente->id)->first();
        $conyugue = Conyugue::where('naturals_id',$natural->id)->first();
        $avals = Aval::where('prestamos_id',$prestamo->id)->get();
        $garantias = Garantia::where('prestamos_id',$prestamo->id)->get();
        $tiene_conyuge = '';
        if($conyugue){
            $tiene_conyuge='SI'; 
        }
        else{
            $tiene_conyuge='NO';
        }    

        return compact('prestamo', 'cliente','avals','garantias','natural','conyugue','tiene_conyuge');
   
    }

    public function prestamoVerJuridico($prestamo)
    {

        $prestamo= Prestamo::find($prestamo);
        $cliente = Cliente::where('id',$prestamo->clientes_id)->first();
        $juridico = Juridico::where('clientes_id',$cliente->id)->first();
        $avals = Aval::where('prestamos_id',$prestamo->id)->get();
        $garantias = Garantia::where('prestamos_id',$prestamo->id)->get();
     
        return compact('prestamo', 'cliente','avals','garantias','juridico');
   
    }

    public function edit(Cliente $cliente)
    {
        //
    }

    private function getUserDir($id)
    {   
        $prestamo = Prestamo::where('id',$id)->first();
        $cliente = Cliente::where('id',$prestamo->clientes_id)->first();
        return $cliente->nombres.'_'. $cliente->apellidos .'_' . $cliente->id;
    }

    public function SolicitudPdf($prestamo){


        $prestamo= Prestamo::find($prestamo);
        $cliente = Cliente::where('id',$prestamo->clientes_id)->first();
        $archivos = Archivo::where('prestamos_id', $prestamo->id)->get();

        if($cliente->tipo_documento == 'RUC'){
            $juridico = Juridico::where('clientes_id',$cliente->id)->first();
            $avals = Aval::where('prestamos_id',$prestamo->id)->get();
            $garantias = Garantia::where('prestamos_id',$prestamo->id)->get(); 

            $pdf = \PDF::loadView('reportes.prestamoJuridico',compact('prestamo','cliente','avals','garantias','juridico'));
            return $pdf->stream('solicitud_de_credito.pdf');

        }
        else
        {
            $natural = Natural::where('clientes_id',$cliente->id)->first();
            $conyugue = Conyugue::where('naturals_id',$natural->id)->first();
            $tiene_conyuge = '';
            if($conyugue){
                $tiene_conyuge='SI'; 
            }
            else{
                $tiene_conyuge='NO';
            }     
    
            $avals = Aval::where('prestamos_id',$prestamo->id)->get();
            $garantias = Garantia::where('prestamos_id',$prestamo->id)->get();
    
    
            $pdf = \PDF::loadView('reportes.prestamo',compact('prestamo','cliente','avals','garantias','natural','conyugue','tiene_conyuge'));
            // return $pdf->stream('solicitud_de_credito.pdf');

            $pdf = new \LynX39\LaraPdfMerger\PdfManage;
            $pdf->addPDF(public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/general/documento/inscripcion_de_socio.pdf'), 'all');

            
                foreach ($archivos as $ep=>$rp) {
                    
                    $pdf->addPDF(public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/'.$rp->tipo.'/'.$rp->nombre.'.'.$rp->extension), 'all');
                }
            
            
            // $pdf->addPDF(public_path('/upload/test.pdf'), 'all');
            $pdf->merge('file', public_path('/upload/created.pdf'), 'P');

            dd('done');

        }

    }

}
