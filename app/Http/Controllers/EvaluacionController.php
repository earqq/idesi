<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestamo;
use App\Negocio;
use App\Cliente;
use App\Natural;
use App\Familiar;
use App\Colegio;
use App\EntidadFinanciera;
use App\Cualitativa;
use App\Evaluacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\ResultadoCuantitativa;

class EvaluacionController extends Controller
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


    public function prestamos(Request $request)
    {
        if(Auth::user()->idrol == '1' || Auth::user()->idrol == '3' || Auth::user()->idrol == '4' ||  Auth::user()->idrol == '5'){
            $prestamo = Prestamo::join('clientes','prestamos.clientes_id',"=","clientes.id")
            ->join('naturals','clientes.id',"=","naturals.clientes_id")
            ->select('clientes.documento','naturals.nombres','naturals.apellidos','prestamos.estado','prestamos.producto','prestamos.importe','prestamos.plazo','prestamos.cualitativa','prestamos.cuantitativa','prestamos.created_at','prestamos.id')
            ->where('clientes.documento', 'LIKE', "%{$request->search_input}%")
            ->orWhere('naturals.nombres', 'LIKE', "%{$request->search_input}%")
            ->orWhere('naturals.apellidos', 'LIKE', "%{$request->search_input}%")
            ->orWhere('prestamos.producto', 'LIKE', "%{$request->search_input}%")
            ->orWhere('prestamos.estado', 'LIKE', "%{$request->search_input}%")
            ->get();
                $rol =  Auth::user()->idrol;
                return compact('prestamo','rol');
        }
        
        elseif(Auth::user()->idrol == '2'){
            $prestamo = Prestamo::join('clientes','prestamos.clientes_id',"=","clientes.id")
            ->join('naturals','clientes.id',"=","naturals.clientes_id")
            ->select('clientes.documento','naturals.nombres','naturals.apellidos','prestamos.estado','prestamos.producto','prestamos.importe','prestamos.plazo','prestamos.cualitativa','prestamos.cuantitativa','prestamos.created_at','prestamos.id')
            ->where('prestamos.users_id','=', Auth::user()->id)
            // ->orWhere(function($q) use($request){
            //     $q->orWhere('clientes.documento', 'LIKE', "%{$request->search_input}%");
            //     $q->orWhere('naturals.nombres', 'LIKE', "%{$request->search_input}%");
            //     $q->orWhere('naturals.apellidos', 'LIKE', "%{$request->search_input}%");
            //     $q->orWhere('prestamos.producto', 'LIKE', "%{$request->search_input}%");
            //     $q->orWhere('prestamos.estado', 'LIKE', "%{$request->search_input}%");
            // })
            ->get();
                $rol =  Auth::user()->idrol;
                return compact('prestamo','rol');
        }

    }

    public function prestamosJuridico(Request $request)
    {
        if(Auth::user()->idrol == '1' || Auth::user()->idrol == '3' || Auth::user()->idrol == '4' ||  Auth::user()->idrol == '5'){
            $prestamo = Prestamo::join('clientes','prestamos.clientes_id',"=","clientes.id")
            ->join('juridicos','clientes.id',"=","juridicos.clientes_id")
            ->select('clientes.documento','juridicos.razon_social','prestamos.estado','prestamos.producto','prestamos.importe','prestamos.plazo','prestamos.cualitativa','prestamos.cuantitativa','prestamos.created_at','prestamos.id')
            ->where('clientes.documento', 'LIKE', "%{$request->search_input}%")
            ->orWhere('juridicos.razon_social', 'LIKE', "%{$request->search_input}%")
            ->orWhere('prestamos.producto', 'LIKE', "%{$request->search_input}%")
            ->orWhere('prestamos.estado', 'LIKE', "%{$request->search_input}%")
            ->get();
                $rol =  Auth::user()->idrol;
                return compact('prestamo','rol');
        }
        
        elseif(Auth::user()->idrol == '2'){
            $prestamo = Prestamo::join('clientes','prestamos.clientes_id',"=","clientes.id")
            ->join('juridicos','clientes.id',"=","juridicos.clientes_id")
            ->select('clientes.documento','juridicos.razon_social','prestamos.estado','prestamos.producto','prestamos.importe','prestamos.plazo','prestamos.cualitativa','prestamos.cuantitativa','prestamos.created_at','prestamos.id')
            ->where('prestamos.users_id',Auth::user()->id)
            // ->orwhere('clientes.documento', 'LIKE', "%{$request->search_input}%")
            // ->orWhere('juridicos.razon_social', 'LIKE', "%{$request->search_input}%")
            // ->orWhere('prestamos.producto', 'LIKE', "%{$request->search_input}%")
            // ->orWhere('prestamos.estado', 'LIKE', "%{$request->search_input}%")
            ->get();
                $usuario = Auth::user()->id; 
                $rol =  Auth::user()->idrol;
                return compact('prestamo','rol');
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
        //
    }


    public function verificarPrestamo($id)
    {
        $evaluacion = Evaluacion::where('prestamos_id',$id)->where('users_id', Auth::user()->id)->first();
        $existe_evaluacion = 0;
        if($evaluacion){
            $existe_evaluacion = 1;
        }
        return $existe_evaluacion;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prestamo = Prestamo::find($id);
        $evaluacion = Evaluacion::join('users','evaluacions.users_id','=','users.id')
                ->select('evaluacions.created_at','evaluacions.detalle','evaluacions.estado','users.name', 'users.idrol')
                ->where('prestamos_id',$prestamo->id)
                ->orderBy('users.idrol', 'DESC')->get();

        $cuantitativa = ResultadoCuantitativa::where('prestamo_id', $prestamo->id)->first();
        $estado_evaluado = 0;

        if(Auth::user()->idrol==4){

            if($prestamo->estado =='PENDIENTE' ){
                $estado_evaluado = 1;
            }
        }else{

            $evaluado = Evaluacion::where('prestamos_id',$id)->where('users_id', Auth::user()->id)->first();
            if(!$evaluado){
                $estado_evaluado = 1;
            }
        }

         return compact('prestamo','evaluacion','cuantitativa','estado_evaluado');
    }

    public function showF($id)
    {
        $prestamo = Prestamo::find($id);
        $evaluacion = Evaluacion::join('users','evaluacions.users_id','=','users.id')
                                    ->select('evaluacions.created_at','evaluacions.detalle','evaluacions.estado','users.name')
                                    ->where('prestamos_id',$prestamo->id)->get();
        
        $cuantitativa = ResultadoCuantitativa::where('prestamo_id', $prestamo->id)->first();
        // $cuantitativa = 
         return compact('prestamo','evaluacion','cuantitativa');
    }
    

    public function propuestaAnalista($id)
    {
        $prestamo = Prestamo::where('id',$id)
                            ->select('producto','importe','plazo','cuotas')->first();

         return $prestamo;
    }

    public function numeroHijos($id)
    {
        $prestamo = Prestamo::where('id',$id)
                            ->select('clientes_id')->first();
        $clientes = Cliente::find($prestamo->clientes_id);
        
        $natural = Natural::where('clientes_id',$clientes->id)->first();
        if($natural){

            $familia = Familiar::where('naturals_id',$natural->id)->select('numero')->first();
            return $familia;
        }

    }




    // public function evaluar($id)
    // {
    //     $prestamo = Prestamo::find($id);
    //     return $prestamo;
    // }

    public function evaluar(Request $request)
    {
            try{
                    DB::beginTransaction();
                    $evaluacion = new Evaluacion();
                    $evaluacion->detalle  = $request['detalle'] ;
                    $evaluacion->estado  = $request['estado'];
                    $evaluacion->prestamos_id  = $request['prestamos_id'];
                    $evaluacion->users_id  = Auth::user()->id;
                    $evaluacion->save();
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

    public function giro(Request $request)
    {
        $negocios = Negocio::all();
        return $negocios;
    }

    // public function searchGiro($giro)
    // {
    //     $negocios = Negocio::where('giro_negocio',$giro)->first();
    //     return $negocios->toJson();
    // } 

    public function colegios()
    {
        $colegio = Colegio::all();
        return $colegio;
    }

    public function entidades()
    {
        $entidades = EntidadFinanciera::all();
        return $entidades;
    } 

    public function colegioCosto(Request $request)
    {
        $colegio = Colegio::where("nivel",$request->grado)
                            ->where('nombre',$request->colegio)
                            ->select('costo')->first();
        return $colegio;
    } 

    public function datosCualitativas($prestamoID)
    {
        $cualitativa = Cualitativa::where('prestamo_id',intval($prestamoID))->first();
        return $cualitativa;

    } 


    public function evaluarFinal(Request $request)
    {
      
            try{

                   DB::beginTransaction();
                    
                   $prestamo = Prestamo::find($request['prestamos_id']);
                   
                   if($request->estado=='DESAPROBADO' ){

                    $prestamo->producto_final = 0;
                    $prestamo->forma_final = 0;
                    $prestamo->aporte_final = 0;
                    $prestamo->importe_final = 0;
                    $prestamo->plazo_final = 0;
                    $prestamo->cuota_final = 0;
                    $prestamo->tasa_final = 0;
                    $prestamo->estado = $request->estado;
                    $prestamo->save();

                   }else{

                    $prestamo->producto_final = $request->producto;
                    $prestamo->aporte_final = $request->aporte;
                    $prestamo->importe_final = $request->importe;
                    $prestamo->plazo_final = $request->plazo;
                    $prestamo->cuota_final = $request->cuotas;
                    $prestamo->tasa_final = $request->tasa;
                    $prestamo->estado = $request->estado;
                    $prestamo->save();

                   }
                   
                   $evaluacion = new Evaluacion();
                   $evaluacion->detalle  = 'LA SOLICITUD FUE '.$request['estado'] ;
                   $evaluacion->estado  = $request['estado'];
                   $evaluacion->prestamos_id  = $request['prestamos_id'];
                   $evaluacion->users_id  = Auth::user()->id;
                   $evaluacion->save();
    
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