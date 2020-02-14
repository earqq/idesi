<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestamo;
use App\Archivo;
use App\Negocio;
use App\Imports\NegociosImport;
use App\Evaluacion;
use App\Cuantitativa;
use App\Cliente;
use App\Cualitativa;
use App\ResultadoAnalisis;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class AnalisisController extends Controller
{

    public function obtenerCualitativa($prestamoID)
    {
        $cualitativa = Cualitativa::where('prestamo_id',intval($prestamoID))->first();
        return $cualitativa;

    } 
    public function saveCuantitativa(Request $request){
    
        try{

            DB::beginTransaction();

                $resultado_eva='';
                $resultado_sist='';
                $participacion_cuota_titular=0;
                $participacion_cuota_contuge=0;
                $participacion_cuota_total=0;
                $participacion_cuota_validacion=0;
                $gasto_financiero_personal_titular=0;
                $gasto_financiero_personal_conyuge=0;
                $gasto_financiero_personal_total=0;
                $gasto_financiero_personal_validacion=0;
                $cuota_institucion_titular=0;
                $cuota_institucion_conyuge=0;
                $cuota_institucion_total=0;
                $cuota_institucion_validacion=0;
                $utilidad_desp_cuota_titular=0;
                $utilidad_desp_cuota_conyuge=0;
                $utilidad_desp_cuota_total=0;
                $utilidad_desp_cuota_validacion=0;
                $gasto_hogar_titular=0;
                $gasto_hogar_conyuge=0;
                $gasto_hogar_total=0;
                $gasto_financiero_validacion=0;
                $gasto_financiero_titular=0;
                $gasto_financiero_personal_titular=0;
                $gasto_financiero_conyuge=0;
                $gasto_financiero_personal_conyuge=0;
                $gasto_financiero_total=0;
                $gasto_financiero_personal_total=0;
                $gasto_financiero_validacion=0;
                $gasto_financiero_personal_validacion=0;
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
                //conyuge
                $costo_venta_conyuge=$ingresos_ventas_conyuge/100*floatval($request->conyuge["margen_costo"]);        
                $costo_venta_conyuge=$costo_venta_conyuge*-1;        
                \Log::alert('Costo de venta conyuge: '.$costo_venta_conyuge);
                //Total
                $costo_venta_total=$costo_venta_titular+$costo_venta_conyuge;
                \Log::alert('Costo de venta total: '.$costo_venta_total);
                //Validacion
                $negocio=negocio::where('giro_negocio',$request->titular["giro_negocio"])->first();
                $costo_venta_validacion=$ingresos_ventas_validacion/100*floatval($negocio->costo_ventas);
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
            

                //SERVICIO LAT
                //titular
                $servicios_lat_titular=(floatval($request->titular["gasto_negocio"][3]["pago"])+floatval($request->titular["gasto_negocio"][4]["pago"]))*-1;
                \Log::alert('servicios latinos titular: '.$servicios_lat_titular);
                //conyuge
                $servicios_lat_conyuge=(floatval($request->conyuge["gasto_negocio"][3]["pago"])+floatval($request->conyuge["gasto_negocio"][4]["pago"]))*-1;
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
                    $gasto_financiero_titular+=$gastos["cuota"];
                }
                $gasto_financiero_titular=$gasto_financiero_titular*-1;
                \Log::alert('gasto financiero titular: '.$gasto_financiero_titular);
                //conyuge
                foreach($request->conyuge["gasto_financiero"] as $gastos){
                    $gasto_financiero_conyuge+=$gastos["cuota"];
                }
                $gasto_financiero_conyuge=$gasto_financiero_conyuge;
                \Log::alert('gasto financiero conyuge: '.$gasto_financiero_conyuge);
                //Total
                $gasto_financiero_total=$gasto_financiero_titular+$gasto_financiero_conyuge;
                \Log::alert('gasto financiero total: '.$gasto_financiero_total);
                //validacion
                $gasto_financiero_validacion=$gasto_financiero_titular;
                $gasto_financiero_validacion=$gasto_financiero_validacion;
                \Log::alert('gasto financiero validacion: '.$gasto_financiero_validacion);

                // UTILIDAD NETA NEGOCIO
                $utilidad_neta_negocio_titular=$margen_bruto_titular+$servicios_lat_titular
                                                +$alquiler_titular
                                                +$empleados_titular
                                                +$gasto_financiero_titular;

                \Log::alert("UTILIDAD neta NEGOCIO TITULAR: ".$utilidad_neta_negocio_titular);


                // conyuge
                $utilidad_neta_negocio_conyuge=$margen_bruto_conyuge+$servicios_lat_conyuge
                                                +$alquiler_conyuge
                                                +$empleados_conyuge
                                                +$gasto_financiero_conyuge;
                \Log::alert("UTILIDAD neta NEGOCIO conyuge: ".$utilidad_neta_negocio_conyuge);

                // total
                $utilidad_neta_negocio_total=$margen_bruto_total+$servicios_lat_total
                                                +$alquiler_total
                                                +$empleados_total
                                                +$gasto_financiero_total;
                \Log::alert("UTILIDAD neta NEGOCIO unidad familiar: ".$utilidad_neta_negocio_total);

                // validacion
                $utilidad_neta_negocio_validacion=$margen_bruto_validacion+$servicios_lat_validacion
                +$alquiler_validacion
                +$empleados_validacion
                +$gasto_financiero_validacion;
                    \Log::alert("UTILIDAD neta NEGOCIO validacion: ".$utilidad_neta_negocio_validacion);
                //OTROS INGRESOS
                //otros ingresos titular
                foreach($request->titular["ingresos_por_categoria"] as $ingreso){
                    $otros_ingresos_titular+=$ingreso["mes"];
                }
                \Log::alert("Otros ingresos titular: ".$otros_ingresos_titular);
                //otros ingresos conyuge
                foreach($request->conyuge["ingresos_por_categoria"] as $ingreso){
                    $otros_ingresos_conyuge+=$ingreso["mes"];
                }
                \Log::alert("Otros ingresos conyuge: ".$otros_ingresos_conyuge);
                //otros ingresos total
                $otros_ingresos_total=$otros_ingresos_titular-$otros_ingresos_conyuge;
                \Log::alert('Otros ingresos total: '.$otros_ingresos_total);
                //otros ingresos validacion
                $otros_ingresos_validacion=$otros_ingresos_titular-$otros_ingresos_conyuge;
                \Log::alert('Otros ingresos validacion: '.$otros_ingresos_validacion);

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

                //GASTOS_FINANCIERO PERSONAL
                //titular
                foreach($request->titular["gasto_financiero_personal"] as $gastos){
                    $gasto_financiero_personal_titular+=$gastos["cuota"];
                }
                $gasto_financiero_personal_titular=$gasto_financiero_personal_titular*-1;
                \Log::alert('gasto financiero personal titular: '.$gasto_financiero_personal_titular);
                //conyuge        
                foreach($request->conyuge["gasto_financiero_personal"] as $gastos){
                    $gasto_financiero_personal_conyuge+=$gastos["cuota"];
                }
                $gasto_financiero_personal_conyuge=$gasto_financiero_personal_conyuge*-1;
                \Log::alert('gasto financiero personal conyuge: '.$gasto_financiero_personal_conyuge);
                //Total
                $gasto_financiero_personal_total=$gasto_financiero_personal_titular+$gasto_financiero_personal_conyuge;
                \Log::alert('gasto financiero personal total: '.$gasto_financiero_personal_total);
                //validacion
                $gasto_financiero_personal_validacion=$gasto_financiero_personal_total;
                \Log::alert('gasto financiero personal validacion: '.$gasto_financiero_personal_validacion);
                //UTILIDAD
                //titular
            
                $disponible_titular=floatval($margen_bruto_titular+$otros_ingresos_titular
                                +$servicios_lat_titular
                                +$alquiler_titular
                                +$empleados_titular
                                +$gasto_financiero_titular
                                +$gasto_financiero_personal_titular
                                +$gasto_hogar_titular);
                \Log::alert("disponible titular: ".$disponible_titular);
                //conyuge
                $disponible_conyuge=floatval($margen_bruto_conyuge+$otros_ingresos_conyuge
                                +$servicios_lat_conyuge
                                +$alquiler_conyuge
                                +$empleados_conyuge
                                +$gasto_financiero_conyuge
                                +$gasto_financiero_personal_conyuge
                                +$gasto_hogar_conyuge);
                \Log::alert("disponible conyuge: ".$disponible_conyuge);
                //total
                $disponible_total=floatval($margen_bruto_total+$otros_ingresos_total
                                +$servicios_lat_total
                                +$alquiler_total
                                +$empleados_total
                                +$gasto_financiero_total
                                +$gasto_financiero_personal_total
                                +$gasto_hogar_total);
                \Log::alert("disponible total: ".$disponible_total);
                //validacion
                $disponible_validacion=floatval($margen_bruto_validacion+$otros_ingresos_validacion
                                +$servicios_lat_validacion
                                +$alquiler_validacion
                                +$empleados_validacion
                                +$gasto_financiero_validacion
                                +$gasto_financiero_personal_validacion
                                +$gasto_hogar_validacion);
                \Log::alert("disponible validacion: ".$disponible_validacion);        
                
                //CUOTA INSTITUCION
                //titular
                $multiplier=1;
                if($request->propuesta["producto"]=='CREDISEMANA')
                $multiplier=4;
                else if($request->propuesta["producto"]=='CREDIDIARIO')
                $multiplier=24;
                else if($request->propuesta["producto"]=='CREDIQUINCENA')
                $multiplier=2;
                else if($request->propuesta["producto"]=='PYME')
                $multiplier=1;
                else if($request->propuesta["producto"]=='PYME ESPECIAL')
                $multiplier=1;
                else if($request->propuesta["producto"]=='CONSUMO')
                $multiplier=1;
                else if($request->propuesta["producto"]=='CONSUMO ESPECIAL')
                $multiplier=1;
                $cuota_institucion_titular=$request->propuesta["cuotas"]*$multiplier;
                \Log::alert("cuota institucion titular: ".$cuota_institucion_titular);

                \Log::alert("cuota institucion conyuge: ".$cuota_institucion_conyuge);
                $cuota_institucion_total=$cuota_institucion_titular;
                \Log::alert("cuota institucion total: ".$cuota_institucion_total);
                $cuota_institucion_validacion=$cuota_institucion_titular;
                \Log::alert("cuota institucion validacion: ".$cuota_institucion_validacion);

                //disponible DESPUES CUOTA
                //titular
                $disponible_desp_cuota_titular=$utilidad_neta_negocio_titular-$cuota_institucion_titular;
                \Log::alert('disponible despues cuota titular: '.$disponible_desp_cuota_titular);
                //conyuge
                $disponible_desp_cuota_conyuge=$disponible_conyuge-$cuota_institucion_conyuge;
                \Log::alert('disponible despues cuota conyuge: '.$disponible_desp_cuota_conyuge);
                //total
                $disponible_desp_cuota_total=$utilidad_neta_negocio_total-$cuota_institucion_total;
                \Log::alert('disponible despues cuota total: '.$disponible_desp_cuota_total);
                //validacion
                $disponible_desp_cuota_validacion=$disponible_validacion-$cuota_institucion_validacion;
                \Log::alert('disponible despues cuota validacion: '.$disponible_desp_cuota_validacion);

                //PARTICIPACION CUOTA
                $participacion_cuota_titular=round(($cuota_institucion_titular/$disponible_titular)*100);
                \Log::alert("participacion cuota titular: ".$participacion_cuota_titular);
                $participacion_cuota_conyuge=0;
                \Log::alert("participacion cuota conyuge: ".$participacion_cuota_conyuge);
                $participacion_cuota_total=round(($cuota_institucion_total/$disponible_total)*100);
                \Log::alert("participacion cuota total: ".$participacion_cuota_total);
                
                // if($disponible_validacion<0) $participacion_cuota_validacion='NO TIENE CAPACIDAD';
                // else 
                    $participacion_cuota_validacion=round(($cuota_institucion_validacion/$utilidad_neta_negocio_validacion)*100);
                \Log::alert("participacion cuota validacion: ".$participacion_cuota_validacion);

                //RESULTADO EVA
                $resultado_eva='NO TIENE CAPACIDAD DE PAGO';
                if($participacion_cuota_total>100 || $participacion_cuota_total<0)
                    $resultado_eva='NO TIENE CAPACIDAD';
                else if($participacion_cuota_total>40)
                    $resultado_eva='POCA CAPACIDAD';
                else 
                    $resultado_eva='CAPACIDAD PERMITIDA SEGUN PARAMETRO';
                
                \Log::alert("resultado eva: ".$resultado_eva);

                //RESULTADO SIST
                $resultado_sist='NO TIENE CAPACIDAD DE PAGO';
                $div=($cuota_institucion_validacion/$utilidad_neta_negocio_validacion)*100;
                if($div>100 || $div<0)
                    $resultado_sist='NO TIENE CAPACIDAD';
                else if($div>40)
                    $resultado_sist='POCA CAPACIDAD';
                else 
                    $resultado_sist='CAPACIDAD PERMITIDA SEGUN PARAMETRO';
                
                \Log::alert("validacion: ".$resultado_sist);

                $balance_activo_caja=0;
                $balance_activo_inventario=0;
                $balance_activo_f=0;
                $balance_pasivo_deudas=0;
                $balance_patrimonio_capital=0;
                $balance_patrimonio_utilidad=0;
                $balance_activo_total=0;
                $balance_patrimonio_total=0;

                $endeudamiento=0;
                $margen_neto=0;
                $liquidez=0;
                $solvencia=0;

                \Log::alert("llega hasta esta parte");
                //PASIVO DEUDAS
                //titular
                foreach($request->titular["gasto_financiero"] as $gasto){
                    $balance_pasivo_deudas+=$gasto["saldo_capital"];
                }//conyuge
                foreach($request->conyuge["gasto_financiero"] as $gasto){
                    $balance_pasivo_deudas+=$gasto["saldo_capital"];
                }
                //titular
                foreach($request->titular["gasto_financiero_personal"] as $gasto){
                    $balance_pasivo_deudas+=$gasto["saldo_capital"];
                }//conyuge
                foreach($request->conyuge["gasto_financiero_personal"] as $gasto){
                    $balance_pasivo_deudas+=$gasto["saldo_capital"];
                }
                \Log::alert('PASIVO DEUDA: '.$balance_pasivo_deudas);
                
                //PATRIMONIO CAPITAL
                foreach($request->propiedades as $propiedad){
                    $balance_patrimonio_capital+=$propiedad["valor_estimado"];
                }
                \Log::alert('PATRIMONIO CAPITAL: '.$balance_patrimonio_capital);

                //PATRIMONIO UTILIDAD
                $balance_patrimonio_utilidad=$disponible_desp_cuota_total;
                \Log::alert('PATRIMONIO UTILIDAD: '.$balance_patrimonio_utilidad);

                //TOTAL PASIVO Y PATRIMONIO
                $balance_patrimonio_total=$balance_pasivo_deudas+$balance_patrimonio_capital+$balance_patrimonio_utilidad;
                \Log::alert("TOTAL PASIVO: ".$balance_patrimonio_total);

                //ACTIVO F
                $balance_activo_f=$balance_patrimonio_capital;
                \Log::alert('ACTIVO F: '.$balance_activo_f);

                //ACTIVO INVENTARIO
                $balance_activo_inventario=$request->titular["valor_inventario"]+$request->conyuge["valor_inventario"];
                \Log::alert('ACTIVO INVENTARIO: '.$balance_activo_inventario);

                //TOTAL ACTIVO
                $balance_activo_total=$balance_patrimonio_total;
                \Log::alert('TOTAL ACTIVO: '.$balance_activo_total);

                //CAJA ACTIVO
                $balance_activo_caja=$balance_activo_total-$balance_activo_f-$balance_activo_inventario;
                \Log::alert('ACTIVO CAJA: '.$balance_activo_caja);

                //RATIOS
                //ENDEUDAMIENTO
                $endeudamiento=$balance_pasivo_deudas/($balance_patrimonio_capital+$balance_patrimonio_utilidad);
                \Log::alert('RATIOS ENDEUDAMIENTO: '.$endeudamiento);
                $endeudamiento_resultado='MAL';
                if($endeudamiento<0.4) $endeudamiento_resultado='BIEN';
                \Log::alert('ENDEUDAMIENTO RESULTADO: '.$endeudamiento_resultado);
                //MARGEN NETO
                if($ingresos_ventas_total>1)
                $margen_neto=$disponible_desp_cuota_total/$ingresos_ventas_total;
                else 
                    $margen_neto=$disponible_desp_cuota_total/1;
                \Log::alert('RATIOS MARGEN NETO: '.$margen_neto);
                $margen_neto_resultado='MAL';
                if($margen_neto>0.05) $margen_neto_resultado='BIEN';
                \Log::alert('MARGEN NETO RESULTADO: '.$margen_neto_resultado);
                //LIQUIDEZ
                if($balance_pasivo_deudas==0)
                $balance_pasivo_deudas=1;
                $liquidez=($balance_activo_caja+$balance_activo_inventario)/$balance_pasivo_deudas;
                \Log::alert('RATIOS LIQUIDEZ: '.$liquidez);
                $liquidez_resultado='MAL';
                if($liquidez>1) $liquidez_resultado='BIEN';
                \Log::alert('LIQUIDEZ RESULTADO: '.$liquidez_resultado);
                //SOLVENCIA
                $solvencia=$balance_activo_total/$balance_pasivo_deudas;
                \Log::alert('RATIOS SOLVENCIA: '.$solvencia);
                $solvencia_resultado='MAL';
                if($solvencia>1.5) $solvencia_resultado='BIEN';
                \Log::alert('SOLVENCIA RESULTADO: '.$solvencia_resultado);

                //FLUJO PARA CREDITOS DIARIOS
                $fc_diario_minimo_ingreso=0;
                $fc_diario_cuota=0;
                $fc_diario_disponible_diario=0;
                $fc_diario_participacion_cuota=0;
                $fc_diario_resultado=0;

                $fc_semanal_minimo_ingreso=0;
                $fc_semanal_cuota=0;
                $fc_semanal_participacion_cuota=0;
                $fc_semanal_resultado=0;
                $fc_semanal_disponible_semana=0;
                $prestamo=prestamo::find($request->prestamo_id);
                if($prestamo->forma=='DIARIO'){

                    // FLUJO PARA CREDITOS DIARIOS MINIMO INGRESO
                    $fc_diario_minimo_ingreso=$request->titular["ingresos_negocio"][0]['lunes'];
                    if($request->titular["ingresos_negocio"][0]['martes'] < $fc_diario_minimo_ingreso && $request->titular["ingresos_negocio"][0]['martes']>0)
                    $fc_diario_minimo_ingreso=$request->titular["ingresos_negocio"][0]['martes'];
                    if($request->titular["ingresos_negocio"][0]['miercoles']<$fc_diario_minimo_ingreso && $request->titular["ingresos_negocio"][0]['miercoles']>0)
                    $fc_diario_minimo_ingreso=$request->titular["ingresos_negocio"][0]['miercoles'];
                    if($request->titular["ingresos_negocio"][0]['jueves']<$fc_diario_minimo_ingreso && $request->titular["ingresos_negocio"][0]['jueves']>0)
                    $fc_diario_minimo_ingreso=$request->titular["ingresos_negocio"][0]['jueves'];
                    if($request->titular["ingresos_negocio"][0]['viernes']<$fc_diario_minimo_ingreso && $request->titular["ingresos_negocio"][0]['viernes']>0)
                    $fc_diario_minimo_ingreso=$request->titular["ingresos_negocio"][0]['viernes'];
                    if($request->titular["ingresos_negocio"][0]['sabado']<$fc_diario_minimo_ingreso && $request->titular["ingresos_negocio"][0]['sabado']>0)
                    $fc_diario_minimo_ingreso=$request->titular["ingresos_negocio"][0]['sabado'];
                    if($request->titular["ingresos_negocio"][0]['domingo']<$fc_diario_minimo_ingreso && $request->titular["ingresos_negocio"][0]['domingo']>0)
                    $fc_diario_minimo_ingreso=$request->titular["ingresos_negocio"][0]['domingo'];    

                    \Log::alert("FLUJO PARA CREDITOS DIARIOS MINIMO INGRESO: ".$fc_diario_minimo_ingreso);
                    
                    \Log::alert("si viene aca: " );
                    \Log::alert($fc_diario_minimo_ingreso);
                    $fc_diario_cuota=$prestamo->cuotas;
                    \Log::alert("FLUJO PARA CREDITOS DIARIOS CUOTA: ".$fc_diario_cuota);
                    
                    $fc_diario_disponible_diario=$fc_diario_minimo_ingreso-$fc_diario_cuota;
                    \Log::alert("FLUJO PARA CREDITOS DIARIOS DISPONIBLE DIARIOS: ".$fc_diario_disponible_diario);
                    if($fc_diario_minimo_ingreso>0)
                        $fc_diario_participacion_cuota=($fc_diario_cuota/$fc_diario_minimo_ingreso)*100;
                    else 
                        $fc_diario_participacion_cuota=($fc_diario_cuota/1)*100;
                    
                    \Log::alert("FLUJO PARA CREDITOS DIARIOS PARTICIPACION CUOTA: ".$fc_diario_participacion_cuota);

                    if($fc_diario_participacion_cuota>100 || $fc_diario_participacion_cuota<0)
                    $fc_diario_resultado='NO TIENE CAPACIDAD';
                    else if($fc_diario_participacion_cuota>50)
                    $fc_diario_resultado='POCA CAPACIDAD';
                    else
                    $fc_diario_resultado='CAPACIDAD PERMITIDA SEGUN PARAMETRO';
                    \Log::alert("FLUJO PARA CREDITOS DIARIOS RESULTADO: ".$fc_diario_resultado);
                }
                if($prestamo->forma=='SEMANAL'){

                    // FLUJO PARA CREDITOS SEMANALES
                    $fc_semanal_minimo_ingreso=$request->titular["ingresos_negocio"][0]['subtotal']/100*80;
                    \Log::alert("FLUJO PARA CREDITOS SEMANALES MINIMO INGRESO: ".$fc_semanal_minimo_ingreso);
                    
                    $fc_semanal_cuota=$prestamo->cuotas;
                    \Log::alert("FLUJO PARA CREDITOS SEMANAL CUOTA: ".$fc_semanal_cuota);
                    
                    $fc_semanal_disponible_semanal=$fc_semanal_minimo_ingreso-$fc_semanal_cuota;
                    \Log::alert("FLUJO PARA CREDITOS SEMANAL DISPONIBLE SEMANAL: ".$fc_semanal_disponible_semanal);
                
                    $fc_semanal_participacion_cuota=$fc_semanal_cuota/$fc_semanal_minimo_ingreso;
                    \Log::alert("FLUJO PARA CREDITOS DIARIOS PARTICIPACION CUOTA: ".$fc_semanal_participacion_cuota);
                    
                    if($fc_semanal_participacion_cuota>100 || $fc_semanal_participacion_cuota<0)
                    $fc_semanal_resultado='NO TIENE CAPACIDAD';
                    else if($fc_semanal_participacion_cuota>50)
                    $fc_semanal_resultado='POCA CAPACIDAD';
                    else
                    $fc_semanal_resultado='CAPACIDAD PERMITIDA SEGUN PARAMETRO';
                    \Log::alert("FLUJO PARA CREDITOS DIARIOS RESULTADO: ".$fc_semanal_resultado);        
                }

                
                $resultado_analisis= new ResultadoAnalisis;
                $resultado_analisis->prestamo_id=$request->prestamo_id;
                $resultado_analisis->participacion_cuota_titular=$participacion_cuota_titular;
                $resultado_analisis->participacion_cuota_total=$participacion_cuota_total;
                $resultado_analisis->participacion_cuota_validacion=$participacion_cuota_validacion;
                $resultado_analisis->resultado_eva=$resultado_eva;
                $resultado_analisis->resultado_sist=$resultado_sist;
                $resultado_analisis->ratios_endeudamiento=$endeudamiento;
                $resultado_analisis->ratios_endeudamiento_resultado=$endeudamiento_resultado;
                $resultado_analisis->ratios_margen_neto=$margen_neto;
                $resultado_analisis->ratios_margen_neto_resultado=$margen_neto_resultado;
                $resultado_analisis->ratios_liquidez=$liquidez;
                $resultado_analisis->ratios_liquidez_resultado=$liquidez_resultado;
                $resultado_analisis->ratios_solvencia=$solvencia;
                $resultado_analisis->ratios_solvencia_resultado=$solvencia_resultado;
                $resultado_analisis->ingresos_ventas_titular=$ingresos_ventas_titular;
                $resultado_analisis->ingresos_ventas_conyuge=$ingresos_ventas_conyuge;
                $resultado_analisis->ingresos_ventas_total=$ingresos_ventas_total;
                $resultado_analisis->ingresos_ventas_validacion=$ingresos_ventas_validacion;
                $resultado_analisis->costo_venta_titular=$costo_venta_titular;
                $resultado_analisis->costo_venta_conyuge=$costo_venta_conyuge;
                $resultado_analisis->costo_venta_total=$costo_venta_total;
                $resultado_analisis->costo_venta_validacion=$costo_venta_validacion;
                $resultado_analisis->margen_bruto_titular=$margen_bruto_titular;
                $resultado_analisis->margen_bruto_conyuge=$margen_bruto_conyuge;
                $resultado_analisis->margen_bruto_total=$margen_bruto_total;
                $resultado_analisis->margen_bruto_validacion=$margen_bruto_validacion;
                $resultado_analisis->otros_ingresos_titular=$otros_ingresos_titular;
                $resultado_analisis->otros_ingresos_conyuge=$otros_ingresos_conyuge;
                $resultado_analisis->otros_ingresos_total=$otros_ingresos_total;
                $resultado_analisis->otros_ingresos_validacion=$otros_ingresos_validacion;
                $resultado_analisis->servicios_lat_titular=$servicios_lat_titular;
                $resultado_analisis->servicios_lat_conyuge=$servicios_lat_conyuge;
                $resultado_analisis->servicios_lat_total=$servicios_lat_total;
                $resultado_analisis->servicios_lat_validacion=$servicios_lat_validacion;
                $resultado_analisis->alquiler_titular=$alquiler_titular;
                $resultado_analisis->alquiler_conyuge=$alquiler_conyuge;
                $resultado_analisis->alquiler_total=$alquiler_total;
                $resultado_analisis->alquiler_validacion=$alquiler_validacion;
                $resultado_analisis->empleados_titular=$empleados_titular;
                $resultado_analisis->empleados_conyuge=$empleados_conyuge;
                $resultado_analisis->empleados_total=$empleados_total;
                $resultado_analisis->empleados_validacion=$empleados_validacion;
                $resultado_analisis->gasto_financiero_titular=$gasto_financiero_titular;
                $resultado_analisis->gasto_financiero_conyuge=$gasto_financiero_conyuge;
                $resultado_analisis->gasto_financiero_total=$gasto_financiero_total;
                $resultado_analisis->gasto_financiero_validacion=$gasto_financiero_validacion;
                $resultado_analisis->gasto_hogar_titular=$gasto_hogar_titular;
                $resultado_analisis->gasto_hogar_conyuge=$gasto_hogar_conyuge;
                $resultado_analisis->gasto_hogar_total=$gasto_hogar_total;
                $resultado_analisis->gasto_hogar_validacion=$gasto_hogar_validacion;

                $resultado_analisis->gasto_financiero_personal_titular=$gasto_financiero_personal_titular;
                $resultado_analisis->gasto_financiero_personal_conyuge=$gasto_financiero_personal_conyuge;
                $resultado_analisis->gasto_financiero_personal_total=$gasto_financiero_personal_total;
                $resultado_analisis->gasto_financiero_personal_validacion=$gasto_financiero_personal_validacion;

                $resultado_analisis->utilidad_neta_negocio_titular=$utilidad_neta_negocio_titular;
                $resultado_analisis->utilidad_neta_negocio_conyuge=$utilidad_neta_negocio_conyuge;
                $resultado_analisis->utilidad_neta_negocio_total=$utilidad_neta_negocio_total;
                $resultado_analisis->utilidad_neta_negocio_validacion=$utilidad_neta_negocio_validacion;

                $resultado_analisis->disponible_titular=$disponible_titular;
                $resultado_analisis->disponible_conyuge=$disponible_conyuge;
                $resultado_analisis->disponible_total=$disponible_total;
                $resultado_analisis->disponible_validacion=$disponible_validacion;

                $resultado_analisis->cuota_institucion_titular=$cuota_institucion_titular;
                $resultado_analisis->cuota_institucion_conyuge=$cuota_institucion_conyuge;
                $resultado_analisis->cuota_institucion_total=$cuota_institucion_total;
                $resultado_analisis->cuota_institucion_validacion=$cuota_institucion_validacion;

                
                // utilidad desp cuota
                $resultado_analisis->utilidad_desp_cuota_titular=$disponible_desp_cuota_titular;
                // $resultado_analisis->utilidad_desp_cuota_conyuge=$disponible_desp_cuota_conyuge;
                $resultado_analisis->utilidad_desp_cuota_total=$disponible_desp_cuota_total;
                $resultado_analisis->utilidad_desp_cuota_validacion=$disponible_desp_cuota_validacion;
                //Balance
                $resultado_analisis->balance_activo_caja=$balance_activo_caja;
                $resultado_analisis->balance_activo_inventario=$balance_activo_inventario;
                $resultado_analisis->balance_activo_f=$balance_activo_f;
                $resultado_analisis->balance_activo_total=$balance_activo_total;
                $resultado_analisis->balance_pasivo_deudas=$balance_pasivo_deudas;
                $resultado_analisis->balance_patrimonio_capital=$balance_patrimonio_capital;
                $resultado_analisis->balance_patrimonio_utilidad=$balance_patrimonio_utilidad;
                $resultado_analisis->balance_patrimonio_total=$balance_patrimonio_total;
                //gastos financieros perosnales
                $resultado_analisis->gasto_financiero_personal_titular=$gasto_financiero_personal_titular;
                $resultado_analisis->gasto_financiero_personal_conyuge=$gasto_financiero_personal_conyuge;
                $resultado_analisis->gasto_financiero_personal_total=$gasto_financiero_personal_total;
                $resultado_analisis->gasto_financiero_personal_validacion=$gasto_financiero_personal_validacion;


                $resultado_analisis->fc_diario_minimo_ingreso=$fc_diario_minimo_ingreso;
                $resultado_analisis->fc_diario_cuota=$fc_diario_cuota;
                $resultado_analisis->fc_diario_disponible_diario=$fc_diario_disponible_diario;
                $resultado_analisis->fc_diario_participacion_cuota=$fc_diario_participacion_cuota;
                $resultado_analisis->fc_diario_resultado=$fc_diario_resultado;

                $resultado_analisis->fc_semanal_minimo_ingreso=$fc_semanal_minimo_ingreso;
                $resultado_analisis->fc_semanal_cuota=$fc_semanal_cuota;
                $resultado_analisis->fc_semanal_participacion_cuota=$fc_semanal_participacion_cuota;
                $resultado_analisis->fc_semanal_resultado=$fc_semanal_resultado;
                $resultado_analisis->fc_semanal_disponible_semana=$fc_semanal_disponible_semana;
                $resultado_analisis->save();
                
                $cuantitativa= new cuantitativa;
                $cuantitativa->prestamo_id=$request->prestamo_id;
                $cuantitativa->resultado_cuantitativa_id=$resultado_analisis->id;
                $cuantitativa->propuesta=$request->propuesta;
                $cuantitativa->titular=$request->titular;
                $cuantitativa->conyuge=$request->conyuge;
                $cuantitativa->probabilidad_infocorp=$request->probabilidad_infocorp;
                $cuantitativa->gastos_hogar=$request->gastos_hogar;
                $cuantitativa->propiedades=$request->propiedades;
                $cuantitativa->save();

                $prestamo = $cuantitativa->prestamo_id;
                $prestamo->cuantitativa=1;
                $prestamo->save();


                $cliente = Cliente::where('id',$prestamo->cliente_id)->first();
                // $pdf = \PDF::loadView('reportes.cuantitativa',compact('cuantitativa'));
                // if (Storage::put('public/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/documento/evaluacion_cuantitativa.pdf', $pdf->output())){
                    
                //     $archivo = new Archivo();
                //     $archivo->nombre = 'evaluacion_cuantitativa';
                //     $archivo->tipo = 'documento';
                //     $archivo->extension='pdf';
                //     $archivo->prestamo_id= $prestamo->id;
                //     $archivo->save();
                // }

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
    
    public function saveCualitativa(Request $request){
        try{

            DB::beginTransaction();
            
            $cualitativa= new cualitativa;
            $cualitativa->prestamo_id=intval($request->prestamo_id);
            $cualitativa->principal=$request->principal;
            $cualitativa->negocio=$request->negocio;
            $cualitativa->vehiculo=$request->vehiculo;
            $cualitativa->familiar=$request->familiar;
            $cualitativa->central_riesgo=$request->central_riesgo;
            $cualitativa->comentario_central_riesgo=$request->comentario_central_riesgo;
            $cualitativa->referencias=$request->referencias;
            $cualitativa->colateral=$request->colateral;
            $cualitativa->comentario_colateral=$request->comentario_colateral;
            $cualitativa->save();

            $prestamo = $cualitativa->prestamo_id;
            $prestamo->cualitativa=1;
            $prestamo->save();

   
 
            // $cliente = Cliente::where('id',$prestamo->cliente_id)->first();
            // $pdf = \PDF::loadView('reportes.cualitativa',compact('cualitativa'));
            // if (Storage::put('public/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/documento/evaluacion_cualitativa.pdf', $pdf->output())){
            //     $archivo = new Archivo();
            //     $archivo->nombre = 'evaluacion_cualitativa';
            //     $archivo->tipo = 'documento';
            //     $archivo->extension='pdf';
            //     $archivo->prestamo_id= $prestamo->id;
            //     $archivo->save();
            // }

 
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
