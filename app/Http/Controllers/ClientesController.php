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
use App\Conyuge;
use App\Persona;
use App\Representante;
use App\Trabajo;
use App\Juridico;
use App\Subido;
use App\Vista;
use App\Hijo;
use App\RepresentanteLegal;
use App\ResultadoCuantitativa;
use App\Obligacion;
use App\Asociativa;
use App\Evaluacion;
use App\Empresa;
use App\Declaracion;
use App\DeclaracionJuridico;
use App\Director;
use App\Accionista;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class ClientesController extends Controller
{

    public function listar($estado,$text=''){
        \Log::alert("paso");
        $clients = Cliente::leftJoin('personas','clientes.id','=','personas.cliente_id')
        ->leftJoin('empresas','clientes.id','=','empresas.cliente_id')
        ->where(function($query) use($estado){
            if($estado!=3){
                $query->where('estado',$estado);
            }
        })
        ->where(function($query) use($text){
            if($text!=''){
                $text=strtoupper($text);
                $query->orWhere('personas.nombres', 'LIKE', "%{$text}%")
                ->orWhere('clientes.documento', 'LIKE', "%{$text}%")
                ->orWhere('personas.apellidos', 'LIKE', "%{$text}%")
                ->orWhere('empresas.razon_social', 'LIKE', "%{$text}%");
            }
        })
        ->where(function($query){
            if(Auth::user()->nivel == '4')
                $query->where('clientes.user_id','=', Auth::user()->id);  
        })
        ->orderBy('clientes.id','desc')
        ->select('clientes.documento',
                'clientes.id',
                'clientes.tipo_cliente',
                'personas.nombres',
                'personas.apellidos',
                'clientes.ubicacion_direccion_declarada', 
                'empresas.razon_social', 
                'clientes.celular', 
                'clientes.estado')
        ->take(30)
        ->get();    
        \Log::alert(" si viene");
        return $clients;
    }


    public function show($id)
    {
        $cliente=Cliente::with('persona.trabajo','persona.conyuge','empresa.representante','prestamos')
        ->find($id);
        return $cliente;        
    }


    public function aceptarSolicitud($id)
    {
        try{

            DB::beginTransaction();
            $cliente = Cliente::find($id);
            $cliente->estado = 2;
            $cliente->save();

            DB::commit();

            return [
                'success' => true
            ];

        } catch (Exception $e){
            return [
                'success' => false,
            ];
            DB::rollBack();
        }
    }

    public function rechazarSolicitud($id)
    {

        try{

            DB::beginTransaction();

            $cliente = Cliente::find($id);
            $cliente->estado = 3;
            $cliente->save();
            DB::commit();
            return [
                'success' => true
            ];

        } catch (Exception $e){
            return [
                'success' => false,
            ];
            DB::rollBack();
        }
    }


    
  

  

    public function visitaStore(Request $request)
    {
 
        $prestamo = Prestamo::find($request->prestamo_id);
        $cliente = Cliente::where('id',$prestamo->clientes_id)->first();
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

                $subidos = Subido::where('prestamos_id', $request['prestamo_id'])->first();
                $subidos->fotos_negocio=1;
                $subidos->save(); 

                $archivo = new Archivo();
                $archivo->nombre= $request->name;
                $archivo->tipo='imagen'; 
                $archivo->extension= 'png';
                $archivo->prestamos_id=$request->prestamo_id;
                $archivo->save();

                $visita = new Vista();
                $visita->imagen= $archivo->id;
                $visita->latitud= $request->latitud;
                $visita->altitud=$request->longitud; 
                $visita->prestamos_id=$request->prestamo_id;
                $visita->save();
        }

        return [
            'success' => true,
            'data' => 'Cliente creado',
        ];
        
       
    }

    public function enviarEvaluar($prestamo)
    {

        try{

            DB::beginTransaction();

            $prestamo = Prestamo::find($prestamo);
            $prestamo->estado = 'PENDIENTE';
            $prestamo->save();
        
            DB::commit();

            return [
                'success' => true
            ];

            } catch (Exception $e){
                return [
                    'success' => false,
                ];
                DB::rollBack();
            }
    }
 
    public function visitas($documento)
    {
        // if (!$request->ajax()) return redirect('/');
        $visita = Vista::join('archivos','vistas.imagen','=','archivos.id')
                        ->select('vistas.latitud','vistas.altitud','vistas.prestamos_id','vistas.created_at','archivos.nombre','archivos.tipo','archivos.extension')
                        ->where('vistas.prestamos_id',$documento)->get();
        $prestamo = Prestamo::find($documento);

        $cliente = Cliente::where('id',$prestamo->clientes_id)->first();

        $evaluacion = Evaluacion::join('users','evaluacions.users_id','=','users.id')
                    ->select('evaluacions.created_at','evaluacions.detalle','evaluacions.estado','users.name', 'users.nivel')
                    ->where('prestamos_id',$prestamo->id)
                    ->orderBy('users.nivel', 'DESC')->get(); 

        return compact('visita','prestamo','evaluacion','cliente');
        
    }

    public function general($documento)
    {

        $cliente = Cliente::where('documento',$documento)->first();
        $persona = Persona::where('clientes_id',$cliente->id)->first();
        $conyugue = Conyuge::where('naturals_id',$persona->id)->first();
        $tiene_conyuge = '';
        if($conyugue){
            $tiene_conyuge='SI'; 
        }
        else{
            $tiene_conyuge='NO';
        }     
        return compact('cliente','persona','conyugue','tiene_conyuge');
    }

    public function generalJuridico($documento)
    {

        $cliente = Cliente::where('documento',$documento)->first();

        $juridico = Juridico::where('clientes_id',$cliente->id)->first();


        return compact('cliente','juridico');
    }

   

    public function prestamoJuridico(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{

            DB::beginTransaction();
            
            $cliente = Cliente::where('documento',$request->cliente['documento'])->first(); 
            $cliente->save();
            $juridico = Juridico::where('clientes_id',$cliente->id)->first();
            $juridico->razon_social = $request->juridico['razon_social'];
            $juridico->nombre_comercial = $request->juridico['nombre_comercial'];
            $juridico->actividad_principal = $request->juridico['actividad_principal'];
            $juridico->partida_registral = $request->juridico['partida_registral'];
            $juridico->fecha_constitucion= $request->juridico['fecha_constitucion'];
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
            $prestamo->cuotas_inicial = $request->input('cuotas_inicial');
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
            
            Aval::where('prestamos_id', $prestamo->id)->delete();

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
                $aval->centro_trabajo = $avals['centro_trabajo'];
                $aval->direccion_trabajo = $avals['direccion_trabajo'];
                $aval->socio = $avals['socio'];
                $aval->codigo_socio = $avals['codigo_socio'];
                $aval->aporte_socio = $avals['aporte_socio'];
                $aval->empresa_ruc = $avals['empresa_ruc'];
                $aval->empresa_razon_social = $avals['empresa_razon_social'];
                $aval->empresa_direccion = $avals['empresa_direccion'];
                $aval->prestamos_id = $prestamo->id;
                $aval->save();
            }

            Garantia::where('prestamos_id', $prestamo->id)->delete();
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

            if($request->input('idprestamo')<0){
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

    // public function prestamoVer($prestamo)
    // {

    //     $prestamo= Prestamo::find($prestamo);
    //     $cliente = Cliente::where('id',$prestamo->clientes_id)->first();
    //     $persona = Persona::where('clientes_id',$cliente->id)->first();
    //     $conyugue = Conyuge::where('naturals_id',$persona->id)->first();
    //     $avals = Aval::where('prestamos_id',$prestamo->id)->get();
    //     $garantias = Garantia::where('prestamos_id',$prestamo->id)->get();
    //     $tiene_conyuge = '';
    //     if($conyugue){
    //         $tiene_conyuge='SI'; 
    //     }
    //     else{
    //         $tiene_conyuge='NO';
    //     }    

    //     return compact('prestamo', 'cliente','avals','garantias','persona','conyugue','tiene_conyuge');
   
    // }

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
        $cliente = Cliente::where('id',$prestamo->cliente_id)->first(); 

        if($cliente->tipo_cliente == 2 ){

            $empresa = Empresa::where('cliente_id',$cliente->id)->first();
            $representante = RepresentanteLegal::where('empresa_id',$empresa->id)->first();

            $avals = Aval::where('prestamo_id',$prestamo->id)->get();
            $garantias = Garantia::where('prestamo_id',$prestamo->id)->get();
            // $evaluacion = Evaluacion::where('prestamos_id',$prestamo->id)->get();

            $pdf = \PDF::loadView('reportes.prestamo',compact('prestamo','cliente','avals','garantias','empresa','representante'));
            return $pdf->stream('solicitud_de_credito.pdf');

        }
        else
        {
            $persona = Persona::where('cliente_id',$cliente->id)->first();
            $conyuge = Conyuge::where('persona_id',$persona->id)->first();

            // return $persona;
            $avals = Aval::where('prestamo_id',$prestamo->id)->get();
            $garantias = Garantia::where('prestamo_id',$prestamo->id)->get();
            // $evaluacion = Evaluacion::where('prestamo_id',$prestamo->id)->get();
    
            $pdf = \PDF::loadView('reportes.prestamo',compact('prestamo','cliente','avals','garantias','persona','conyuge'));
            return $pdf->stream('solicitud_de_credito.pdf');

        }


    }


    public function entregarPrestamo($prestamo)
    {
        return "asdasdasdsa";
        
    }

    public function AdjuntarPdf($prestamo){


        $prestamo= Prestamo::find($prestamo);
        $cliente = Cliente::where('id',$prestamo->clientes_id)->first();
        $archivos = Archivo::where('prestamos_id', $prestamo->id)->get();

        if(Storage::disk('local')->exists('/public/'.$cliente->documento.'_'.$cliente->id.'/general/documento/adjunto_'.$cliente->documento.'.pdf')){
            if(Storage::disk('local')->delete('/public/'.$cliente->documento.'_'.$cliente->id.'/general/documento/adjunto_'.$cliente->documento.'.pdf')){

                if(Storage::disk('local')->exists('/public/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/documento/solicitud_credito.pdf')){
                    if(Storage::disk('local')->delete('/public/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/documento/solicitud_credito.pdf')){

                    }
                }
            }

        }


        if($cliente->tipo_documento == 'RUC'){

            $juridico = Juridico::where('clientes_id',$cliente->id)->first();
            $avals = Aval::where('prestamos_id',$prestamo->id)->get();
            $garantias = Garantia::where('prestamos_id',$prestamo->id)->get(); 
            $evaluacion = Evaluacion::where('prestamos_id',$prestamo->id)->get();
            $pdf = \PDF::loadView('reportes.prestamoJuridico',compact('prestamo','cliente','avals','garantias','juridico','evaluacion'));
            Storage::put('public/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/documento/solicitud_credito.pdf', $pdf->output());

            $pdf = new \LynX39\LaraPdfMerger\PdfManage;
            $pdf->addPDF(public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/general/documento/inscripcion_de_socio.pdf'), 'all');
            $pdf->addPDF(public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/documento/solicitud_credito.pdf'), 'all');

            foreach ($archivos as $ep=>$rp) {
                if($rp->tipo=='documento'){
                    
                    $pdf->addPDF(public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/'.$rp->tipo.'/'.$rp->nombre.'.'.$rp->extension), 'all');
                
                }
            }

            foreach ($archivos as $ep=>$rp) {

                if($rp->tipo=='imagen'){
                    $pdf->addPDF(public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/imagenpdf/'.$rp->nombre.'.pdf'), 'all');
                }
            }

            // $pdf->merge('file', public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/general/documento/adjunto_'.$cliente->documento.'.pdf'), 'P');
            $pdf->merge("archivo_adjunto.pdf", "download");
        }
        else
        {
            $persona = Persona::where('clientes_id',$cliente->id)->first();
            $conyugue = Conyuge::where('naturals_id',$persona->id)->first();
            $avals = Aval::where('prestamos_id',$prestamo->id)->get();
            $garantias = Garantia::where('prestamos_id',$prestamo->id)->get();
            $evaluacion = Evaluacion::where('prestamos_id',$prestamo->id)->get();
            $tiene_conyuge = '';
            
            if($conyugue){
                $tiene_conyuge='SI'; 
            }
            else{
                $tiene_conyuge='NO'; 
            }     
            
            $pdf = \PDF::loadView('reportes.prestamo',compact('prestamo','cliente','avals','garantias','persona','conyugue','tiene_conyuge','evaluacion'));
            Storage::put('public/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/documento/solicitud_credito.pdf', $pdf->output());

            $pdf = new \LynX39\LaraPdfMerger\PdfManage;
            $pdf->addPDF(public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/general/documento/inscripcion_de_socio.pdf'), 'all');
            $pdf->addPDF(public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/documento/solicitud_credito.pdf'), 'all');

            foreach ($archivos as $ep=>$rp) {
                if($rp->tipo=='documento'){

                    $pdf->addPDF(public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/'.$rp->tipo.'/'.$rp->nombre.'.'.$rp->extension), 'all');
                }
            }
            foreach ($archivos as $ep=>$rp) {
                if($rp->tipo=='imagen'){
                    $pdf->addPDF(public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/imagenpdf/'.$rp->nombre.'.pdf'), 'all');
                }
            }

            $pdf->merge("archivo_adjunto.pdf", "download");
            // $pdf->save('file', public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/general/documento/adjunto_'.$cliente->documento.'.pdf'), 'download');


            




        }

    }

}
