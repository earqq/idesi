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
}
