<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestamo;
use App\Negocio;
use App\Evaluacion;
use App\Cuantitativa;
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
        $pretamos = Prestamo::join('clientes','prestamos.clientes_id',"=","clientes.id")
                              ->join('naturals','clientes.id',"=","naturals.clientes_id")
                              ->select('clientes.documento','naturals.nombres','naturals.apellidos','prestamos.estado','prestamos.created_at','prestamos.id')->get();
        return $pretamos;
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


    // public function evaluar($id)
    // {
    //     $prestamo = Prestamo::find($id);
    //     return $prestamo;
    // }

    public function evaluar(Request $request)
    {
        if($request['tipo']=='APROBADO'){
            $evaluacion = new Evaluacion();
            $evaluacion->producto  = $request['producto'] ;
            $evaluacion->aporte  = $request['aporte'];
            $evaluacion->importe  = $request['importe'];
            $evaluacion->plazo  = $request['plazo'];
            $evaluacion->cuotas  = $request['cuotas'];
            $evaluacion->tasa  = $request['tasa'];
            $evaluacion->estado  = $request['tipo'];
            $evaluacion->prestamos_id  = $request['prestamos_id'];
            $evaluacion->users_id  = '1';
            $evaluacion->save();
            // $prestamo = Prestamo::find($request['prestamos_id']);
            // $prestamo->estado = $request['tipo'];
            // $prestamo->save();
        }
        elseif($request['tipo']=='OBSERVADO'){

        }
        elseif($request['tipo']=='DESAPROBADO'){
            $evaluacion = new Evaluacion();
            $evaluacion->producto  = 00;
            $evaluacion->aporte  = 00;
            $evaluacion->importe  = 00;
            $evaluacion->plazo  = 00;
            $evaluacion->cuotas  = 00;
            $evaluacion->tasa  = 00;
            $evaluacion->estado  = $request['tipo'];
            $evaluacion->prestamos_id  = $request['prestamos_id'];
            $evaluacion->users_id  = '1';
            $evaluacion->save();
        }
        // return $request['tipo'];
    }
    public function saveNegocios(){
        $negocio= new Negocio;
        $negocio->nombre='ABARROTES POR MAYOR';
        $negocio->margen=11;
        $negocio->costo=89;
        $negocio->save();
        $negocio= new Negocio;
        $negocio->nombre='ABARROTES POR MENOR';
        $negocio->margen=16;
        $negocio->costo=84;
        $negocio->save();
        $negocio= new Negocio;
        $negocio->nombre='ALIMENTO BALANCEADO';
        $negocio->margen=36;
        $negocio->costo=64;
        $negocio->save();
        $negocio= new Negocio;
        $negocio->nombre='TRANSPORTE BAJAJ';
        $negocio->margen=30;
        $negocio->costo=70;
        $negocio->save();
        $negocio= new Negocio;
        $negocio->nombre='ALIMENTOS PREPARADOS';
        $negocio->margen=55;
        $negocio->costo=45;
        $negocio->save();
        $negocio= new Negocio;
        $negocio->nombre='ALQUILER DE INMUEBLES';
        $negocio->margen=90;
        $negocio->costo=10;
        $negocio->save();
        $negocio= new Negocio;
        $negocio->nombre='ALQUILER TRAJES Y EQUIPOS';
        $negocio->margen=95;
        $negocio->costo=5;
        $negocio->save();
        $negocio= new Negocio;
        $negocio->nombre='ARTESANIA';
        $negocio->margen=42;
        $negocio->costo=58;
        $negocio->save();
        $negocio= new Negocio;
        $negocio->nombre='ARTICULOS DE HOGAR VENTA';
        $negocio->margen=50;
        $negocio->costo=50;
        $negocio->save();
        $negocio= new Negocio;
        $negocio->nombre='ARTICULOS DE LIMPIEZA';
        $negocio->margen=32;
        $negocio->costo=68;
        $negocio->save();
        $negocio= new Negocio;
        $negocio->nombre='BAZAR LIBRERIA';
        $negocio->margen=35;
        $negocio->costo=65;
        $negocio->save();      

    }
    public function saveCuantitativa(Request $request){
        // $cuantitativa= new cuantitativa;
        // $cuantitativa->promedio=0;
        // $cuantitativa->save();
        $resultado_eva='';
        $resultado_sist='';
        $participacion_cuota_titular=0;
        $participacion_cuota_contuge=0;
        $participacion_cuota_total=0;
        $participacion_cuota_validacion=0;
        $utilidad_titular=0;
        $utilidad_conyuge=0;
        $utilidad_total=0;
        $utilidad_validacion=0;
        $cuota_institucion_titular=0;
        $cuota_institucion_conyuge=0;
        $cuota_institucion_total=0;
        $cuota_institucion_validacion=0;
        $utilidad_despues_cuota_titular=0;
        $utilidad_despues_cuota_conyuge=0;
        $utilidad_despues_cuota_total=0;
        $utilidad_despues_cuota_validacion=0;
        $gasto_hogar_titular=0;
        $gasto_hogar_conyuge=0;
        $gasto_hogar_total=0;
        $gasto_financieros_validacion=0;
        $gasto_financieros_titular=0;
        $gasto_financieros_conyuge=0;
        $gasto_financieros_total=0;
        $gasto_financieros_validacion=0;
        $empleados_titular=0;
        $empleados_conyuge=0;
        $empleados_total=0;
        $empleados_validacion=0;
        $alquiler_titular=0;
        $alquiler_conyuge=0;
        $alquiler_total=0;
        $alquiler_validacion=0;
        $servicios_lat_titular=0;
        $servicios_lat_conyuge=0;
        $servicios_lat_total=0;
        $servicios_lat_validacion=0;
        $otros_ingresos_titular=0;
        $otros_ingresos_conyuge=0;
        $otros_ingresos_total=0;
        $otros_ingresos_validacion=0;
        $margen_bruto_titular=0;
        $margen_bruto_conyuge=0;
        $margen_bruto_total=0;
        $margen_bruto_validacion=0;
        $costo_venta_titular=0;
        $costo_venta_conyuge=0;
        $costo_venta_total=0;
        $costo_venta_validacion=0;
        $ingresos_ventas_titular=0;
        $ingresos_ventas_conyuge=0;
        $ingresos_ventas_total=0;
        $ingresos_ventas_validacion=0;
        //INGRESOS / VENTAS
        //ingresos del titular  - ingresos negocio
        foreach($request->titular["ingresos_negocio"] as $ingreso_negocio){
            $ingresos_ventas_titular+=$ingreso_negocio['subtotal'];
        }
        $ingresos_ventas_titular=floatval($ingresos_ventas_titular)*4;
        \Log::alert('Ingresos ventas titular: '.$ingresos_ventas_titular);
        //ingresos del conyuge  - ingresos negocio
        foreach($request->conyuge["ingresos_negocio"] as $ingreso_negocio){
            if(isset($ingreso_negocio["subtotal"]))
            $ingresos_ventas_conyuge+=$ingreso_negocio['subtotal'];
        }
        $ingresos_ventas_conyuge=floatval($ingresos_ventas_conyuge)*4;
        \Log::alert('Ingresos ventas conyuge: '.$ingresos_ventas_conyuge);
        //total de ingresos
        $ingresos_ventas_total=$ingresos_ventas_titular+$ingresos_ventas_conyuge;
        \Log::alert('Ingresos ventas total: '.$ingresos_ventas_total);
        //ingresos del titular  - ingresos negocio
        foreach($request->titular["ingresos_negocio"] as $ingreso_negocio){
            $ingresos_ventas_validacion+=$ingreso_negocio['subtotal'];
        }
        $ingresos_ventas_validacion=floatval($ingresos_ventas_validacion)*4;
        \Log::alert('Ingresos ventas validacion: '.$ingresos_ventas_validacion);
        //COSTOS DE VENTA
        //Titular
        $costo_venta_titular=$ingresos_ventas_titular/100*floatval($request->titular["margen_costo"]);
        $costo_venta_titular=$costo_venta_titular*-1;        
        \Log::alert('Costo de venta titular: '.$costo_venta_titular);
        //Conyuge
        $costo_venta_conyuge=$ingresos_ventas_conyuge/100*floatval($request->conyuge["margen_costo"]);        
        $costo_venta_conyuge=$costo_venta_conyuge*-1;        
        \Log::alert('Costo de venta conyuge: '.$costo_venta_conyuge);
        //Total
        $costo_venta_total=$costo_venta_titular+$costo_venta_conyuge;
        \Log::alert('Costo de venta total: '.$costo_venta_total);
        //Validacion
        $negocio=negocio::where('nombre',$request->titular["giro_negocio"])->first();
        \Log::alert("negocio");
        \Log::alert(floatval($negocio->costo));
        $costo_venta_validacion=$ingresos_ventas_validacion/100*floatval($negocio->costo);
        \Log::alert('Costo de venta validacion: '.$costo_venta_validacion);
        //MARGEN BRUTO
        //Margen bruto titular
        $margen_bruto_titular=$ingresos_ventas_titular+$costo_venta_titular;
        \Log::alert('Margen bruto titular: '.$margen_bruto_titular);
        //Margen bruto conyuge
        $margen_bruto_conyuge=$ingresos_ventas_conyuge+$costo_venta_conyuge;
        \Log::alert('Margen bruto conyuge: '.$margen_bruto_conyuge);
        //Margen bruto total
        $margen_bruto_total=$margen_bruto_titular+$margen_bruto_conyuge;
        \Log::alert('Margen bruto titular: '.$margen_bruto_total);
        //Margen bruto validacion
        $margen_bruto_validacion=$ingresos_ventas_validacion-$costo_venta_validacion;
        \Log::alert('Margen bruto titular: '.$margen_bruto_validacion);
        //OTROS INGRESOS
        //otros ingresos titular
        foreach($request->titular["ingresos_por_categoria"] as $ingreso){
            $otros_ingresos_titular+=$ingreso["mes"];
        }
        \Log::alert("Otros ingresos conyuge: ".$otros_ingresos_conyuge);
          //otros ingresos conyuge
        foreach($request->conyuge["ingresos_por_categoria"] as $ingreso){
            $otros_ingresos_conyuge+=$ingreso["mes"];
        }
        \Log::alert("Otros ingresos conyuge: ".$otros_ingresos_conyuge);
        //otros ingresos total
        $otros_ingresos_total=$otros_ingresos_titular-$otros_ingresos_conyuge;
        \Log::alert('Otros ingresos total: '.$otros_ingresos_total);

        //SERVICIO LAT
        //titular
        $servicios_lat_titular=floatval($request->titular["gasto_negocio"][3]["pago"])*-1;
        \Log::alert('servicios latinos titular: '.$servicios_lat_titular);
        //conyuge
        $servicios_lat_conyuge=floatval($request->conyuge["gasto_negocio"][3]["pago"])*-1;
        \Log::alert('servicios latinos conyuge: '.$servicios_lat_conyuge);
        //total
        $servicios_lat_total=$servicios_lat_titular+$servicios_lat_conyuge;
        \Log::alert('servicios latinos total: '.$servicios_lat_total);
        //validacion
        $servicios_lat_validacion=floatval($request->titular["gasto_negocio"][3]["pago"])*-1;
        \Log::alert('servicios latinos validacion: '.$servicios_lat_validacion);
        //SERVICIO ALQUILER
        //titular
        $alquiler_titular=floatval($request->titular["gasto_negocio"][0]["pago"])*-1;
        \Log::alert('alquiler titular: '.$alquiler_titular);
        //conyuge
        $alquiler_conyuge=floatval($request->conyuge["gasto_negocio"][0]["pago"])*-1;
        \Log::alert('alquiler conyuge: '.$alquiler_conyuge);
        //total
        $alquiler_total=$alquiler_titular+$alquiler_conyuge;
        \Log::alert('alquiler total: '.$alquiler_total);
        //validacion
        $alquiler_validacion=floatval($request->titular["gasto_negocio"][0]["pago"])*-1;
        \Log::alert('alquiler validacion: '.$alquiler_validacion);
        //SERVICIO EMPLEADOS
        //titular
        $empleados_titular=floatval($request->titular["gasto_negocio"][1]["pago"])*-1;
        \Log::alert('empleados titular: '.$empleados_titular);
        //conyuge
        $empleados_conyuge=floatval($request->conyuge["gasto_negocio"][1]["pago"])*-1;
        \Log::alert('empleados conyuge: '.$empleados_conyuge);
        //total
        $empleados_total=$empleados_titular+$empleados_conyuge;
        \Log::alert('empleados total: '.$empleados_total);
        //validacion
        $empleados_validacion=floatval($request->titular["gasto_negocio"][1]["pago"])*-1;
        \Log::alert('empleados validacion: '.$empleados_validacion);
        
        //GASTOS_FINANCIEROS
        //titular
        foreach($request->titular["gasto_financiero"] as $gastos){
            $gasto_financieros_titular+=$gastos["cuota"];
        }
        $gasto_financieros_titular=$gasto_financieros_titular*-1;
        \Log::alert('gasto financiero titular: '.$gasto_financieros_titular);
        //conyuge
        foreach($request->conyuge["gasto_financiero"] as $gastos){
            $gasto_financieros_conyuge+=$gastos["cuota"];
        }
        $gasto_financieros_conyuge=$gasto_financieros_conyuge*-1;
        \Log::alert('gasto financiero conyuge: '.$gasto_financieros_conyuge);
        //Total
        $gasto_financieros_total=$gasto_financieros_titular+$gasto_financieros_conyuge;
        \Log::alert('gasto financiero total: '.$gasto_financieros_total);
        //validacion
        $gasto_financieros_validacion=$gasto_financieros_titular;
        $gasto_financieros_validacion=$gasto_financieros_validacion;
        \Log::alert('gasto financiero validacion: '.$gasto_financieros_validacion);
        //GASTOS_HOGAR
        //titular
        foreach($request->gastos_hogar as $gastos){
            $gasto_hogar_titular+=$gastos["pago"];
        }
        $gasto_hogar_titular=$gasto_hogar_titular*-1;
        \Log::alert('gasto hogar titular: '.$gasto_hogar_titular);
        //conyuge        
        \Log::alert('gasto hogar conyuge: '.$gasto_hogar_conyuge);
        $gasto_hogar_conyuge=$gasto_hogar_conyuge*-1;
        //Total
        $gasto_hogar_total=$gasto_hogar_titular+$gasto_hogar_conyuge;
        \Log::alert('gasto hogar total: '.$gasto_hogar_total);
        //validacion
        $gasto_hogar_validacion=$gasto_hogar_titular;
        \Log::alert('gasto hogar validacion: '.$gasto_hogar_validacion);

        //UTILIDAD
        //titular
    
        $utilidad_titular=floatval($margen_bruto_titular+$otros_ingresos_titular
                        +$servicios_lat_titular
                        +$alquiler_titular
                        +$empleados_titular
                        +$gasto_financieros_titular
                        +$gasto_hogar_titular);
        \Log::alert("utilidad titular: ".$utilidad_titular);
        //conyuge
        $utilidad_conyuge=floatval($margen_bruto_conyuge+$otros_ingresos_conyuge
                        +$servicios_lat_conyuge
                        +$alquiler_conyuge
                        +$empleados_conyuge
                        +$gasto_financieros_conyuge
                        +$gasto_hogar_conyuge);
        \Log::alert("utilidad conyuge: ".$utilidad_conyuge);
        //total
        $utilidad_total=floatval($margen_bruto_total+$otros_ingresos_total
                        +$servicios_lat_total
                        +$alquiler_total
                        +$empleados_total
                        +$gasto_financieros_total
                        +$gasto_hogar_total);
        \Log::alert("utilidad total: ".$utilidad_total);
        //validacion
        $utilidad_validacion=floatval($margen_bruto_validacion+$otros_ingresos_validacion
                        +$servicios_lat_validacion
                        +$alquiler_validacion
                        +$empleados_validacion
                        +$gasto_financieros_validacion
                        +$gasto_hogar_validacion);
        \Log::alert("utilidad validacion: ".$utilidad_validacion);        
        
        //CUOTA INSTITUCION
        //titular
        $multiplier=1;
        if($request->solicitud_credito["producto"]=='CREDISEMANA')
        $multiplier=4;
        else if($request->solicitud_credito["producto"]=='CREDIDIARIO')
        $multiplier=24;
        else if($request->solicitud_credito["producto"]=='CREDIQUINCENA')
        $multiplier=2;
        else if($request->solicitud_credito["producto"]=='PYME')
        $multiplier=1;
        else if($request->solicitud_credito["producto"]=='PYME ESPECIAL')
        $multiplier=1;
        else if($request->solicitud_credito["producto"]=='CONSUMO')
        $multiplier=1;
        else if($request->solicitud_credito["producto"]=='CONSUMO ESPECIAL')
        $multiplier=1;
        $cuota_institucion_titular=$request->solicitud_credito["cuotas"]*$multiplier;
        \Log::alert("cuota institucion titular: ".$cuota_institucion_titular);

        \Log::alert("cuota institucion conyuge: ".$cuota_institucion_conyuge);
        $cuota_institucion_total=$cuota_institucion_titular;
        \Log::alert("cuota institucion total: ".$cuota_institucion_total);
        $cuota_institucion_validacion=$cuota_institucion_titular;
        \Log::alert("cuota institucion validacion: ".$cuota_institucion_validacion);

        //UTILIDAD DESPUES CUOTA
        //titular
        $utilidad_despues_cuota_titular=$utilidad_titular-$cuota_institucion_titular;
        \Log::alert('utilidad despues cuota titular: '.$utilidad_despues_cuota_titular);
        //conyuge
        $utilidad_despues_cuota_conyuge=$utilidad_conyuge-$cuota_institucion_conyuge;
        \Log::alert('utilidad despues cuota conyuge: '.$utilidad_despues_cuota_conyuge);
        //total
        $utilidad_despues_cuota_total=$utilidad_total-$cuota_institucion_total;
        \Log::alert('utilidad despues cuota total: '.$utilidad_despues_cuota_total);
        //validacion
        $utilidad_despues_cuota_validacion=$utilidad_validacion-$cuota_institucion_validacion;
        \Log::alert('utilidad despues cuota validacion: '.$utilidad_despues_cuota_validacion);

        //PARTICIPACION CUOTA
        $participacion_cuota_titular=round(($cuota_institucion_titular/$utilidad_titular)*100);
        \Log::alert("participacion cuota titular: ".$participacion_cuota_titular);
        $participacion_cuota_conyuge=0;
        \Log::alert("participacion cuota conyuge: ".$participacion_cuota_conyuge);
        $participacion_cuota_total=round(($cuota_institucion_total/$utilidad_total)*100);
        \Log::alert("participacion cuota total: ".$participacion_cuota_total);
        $participacion_cuota_validacion=round(($cuota_institucion_validacion/$utilidad_validacion)*100);
        \Log::alert("participacion cuota validacion: ".$participacion_cuota_validacion);

        //RESULTADO EVA
        $resultado_eva='NO TIENE CAPACIDAD DE PAGO';
        if($participacion_cuota_total>100 || $participacion_cuota_total<0)
            $resultado_eva='NO TIENE CAPACIDAD';
        else if($participacion_cuota_total>40)
            $resultado_eva='POCA CAPACIDAD';
        else 
            $resultado_eva='TIENE CAPACIDAD';
        
        \Log::alert("resultado eva: ".$resultado_eva);

        //RESULTADO SIST
        $resultado_sist='NO TIENE CAPACIDAD DE PAGO';
        if($participacion_cuota_validacion>100 || $participacion_cuota_validacion<0)
            $resultado_sist='NO TIENE CAPACIDAD';
        else if($participacion_cuota_validacion>40)
            $resultado_sist='POCA CAPACIDAD';
        else 
            $resultado_sist='TIENE CAPACIDAD';
        
        \Log::alert("resultado eva: ".$resultado_sist);
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
