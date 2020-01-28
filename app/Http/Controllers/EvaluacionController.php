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


    public function prestamos()
    {
        if(Auth::user()->idrol == '1' || Auth::user()->idrol == '3' || Auth::user()->idrol == '4'){
            $prestamo = Prestamo::join('clientes','prestamos.clientes_id',"=","clientes.id")
            ->join('naturals','clientes.id',"=","naturals.clientes_id")
            ->select('clientes.documento','naturals.nombres','naturals.apellidos','prestamos.estado','prestamos.producto','prestamos.importe','prestamos.plazo','prestamos.created_at','prestamos.id')->get();

                $usuario = Auth::user()->id; 
                $rol =  Auth::user()->idrol;

                return compact('prestamo','usuario','rol');
        }
        
        elseif(Auth::user()->idrol == '2'){
            $prestamo = Prestamo::join('clientes','prestamos.clientes_id',"=","clientes.id")
            ->join('naturals','clientes.id',"=","naturals.clientes_id")
            ->select('clientes.documento','naturals.nombres','naturals.apellidos','prestamos.estado','prestamos.producto','prestamos.importe','prestamos.plazo','prestamos.created_at','prestamos.id')
            ->where('prestamos.users_id',Auth::user()->id)->get();

                $usuario = Auth::user()->id; 
                $rol =  Auth::user()->idrol;
                return compact('prestamo','usuario','rol');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prestamo = Prestamo::find($id);
        return $prestamo;
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

        $familia = Familiar::where('naturals_id',$natural->id)->select('numero')->first();

        return $familia;
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

    public function datosCualitativas(Request $request)
    {
        $cualitativa = Cualitativa::where('prestamo_id',intval($request->prestamo))->first();
        return $cualitativa;

    } 


    public function evaluarFinal(Request $request)
    {
      
            try{

                   DB::beginTransaction();
                    
                   $prestamo = Prestamo::find($request['prestamos_id']);
                   
                   if($request['estado']=='DESAPROBADO' ){

                    $prestamo->producto_final = 0;
                    $prestamo->forma_final = 0;
                    $prestamo->aporte_final = 0;
                    $prestamo->importe_final = 0;
                    $prestamo->plazo_final = 0;
                    $prestamo->cuota_final = 0;
                    $prestamo->tasa_final = 0;
                    $prestamo->estado = $request['estado'];
                    $prestamo->save();

                   }else{

                    $prestamo->producto_final = $request['producto'];
                    $prestamo->aporte_final = $request['aporte'];
                    $prestamo->importe_final = $request['importe'];
                    $prestamo->plazo_final = $request['plazo'];
                    $prestamo->cuota_final = $request['cuotas'];
                    $prestamo->tasa_final = $request['tasa'];
                    $prestamo->estado = $request['estado'];
                    $prestamo->save();

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