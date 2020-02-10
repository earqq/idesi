<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestamo;
use Auth;
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

            // return $request;
            DB::beginTransaction();
            
            $cliente = Cliente::where('documento',$request->cliente['documento'])->first(); 
            $cliente->save();

            $persona = Persona::where('clientes_id',$cliente->id)->first();
            $persona->celular = $request->persona['celular'];
            $persona->nombres = $request->persona['nombres'];
            $persona->apellidos = $request->persona['apellidos'];
            $persona->centro_trabajo = $request->persona['centro_trabajo'];
            $persona->direccion_cliente = $request->persona['direccion'];
            $persona->direccion_trabajo = $request->persona['direccion_trabajo'];
            $persona->estado_civil = $request->persona['estado_civil'];
            $persona->nacimiento = $request->persona['nacimiento'];
            $persona->ocupacion = $request->persona['ocupacion'];
            $persona->referencia = $request->persona['referencia'];
            $persona->telefono = $request->persona['telefono'];
            $persona->tipo_domicilio =  $request->persona['tipo_domicilio'];
            $persona->save();
            if($request->conyugue['conyuge_tiene']=='SI'){
                $conyugue = Conyuge::where('naturals_id',$persona->id)->first();
                if(!$conyugue){
                    $conyugue = new Conyuge;
                }   
                $conyugue->centro_trabajo= $request->conyugue['centro_trabajo_conyugue'];
                $conyugue->direccion = $request->conyugue['direccion_trabajo_conyugue'] ;
                $conyugue->documento = $request->conyugue['documento_conyugue'] ;
                $conyugue->estado_civil =  $request->conyugue['estado_civil_conyugue'] ;
                   $conyugue->nacimiento =  $request->conyugue['nacimiento_conyugue'];
                   $conyugue->nombres =  $request->conyugue['nombres_conyugue'];
                   $conyugue->ocupacion =  $request->conyugue['ocupacion_conyugue'];
                   $conyugue->telefono =  $request->conyugue['telefono_conyugue'] ;
                   $conyugue->celular =  $request->conyugue['celular_conyugue'];
                   $conyugue->trabaja =  $request->conyugue['trabaja_conyugue'];
                   $conyugue->socio =  $request->conyugue['socio_conyugue'];
                   $conyugue->codigo_socio =  $request->conyugue['codigo_socio_conyugue'];
                   $conyugue->aporte_socio =  $request->conyugue['aporte_socio_conyugue'];
                   $conyugue->naturals_id = $persona->id;   
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
                        $garantia->tipo = $garantias['tipo'];
                    }else{
                        $garantia->declaracion_jurada = 'SI';
                        $garantia->tipo = $garantias['tipo'];
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
