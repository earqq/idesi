<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $prestamo_id
 * @property float $participacion_cuota_titular
 * @property float $participacion_cuota_total
 * @property float $participacion_cuota_validacion
 * @property string $resultado_eva
 * @property string $resultado_sist
 * @property float $ratios_endeudamiento
 * @property string $ratios_endeudamiento_resultado
 * @property float $ratios_margen_neto
 * @property string $ratios_margen_neto_resultado
 * @property float $ratios_liquidez
 * @property string $ratios_liquidez_resultado
 * @property float $ratios_solvencia
 * @property string $ratios_solvencia_resultado
 * @property float $ingresos_ventas_titular
 * @property float $ingresos_ventas_CONYUGE
 * @property float $ingresos_ventas_total
 * @property float $ingresos_ventas_validacion
 * @property float $costo_venta_titular
 * @property float $costo_venta_CONYUGE
 * @property float $consto_venta_total
 * @property float $costo_venta_validacion
 * @property float $margen_bruto_titular
 * @property float $margen_bruto_CONYUGE
 * @property float $margen_bruto_total
 * @property float $margen_bruto_validacion
 * @property float $otros_ingresos_titular
 * @property float $otros_ingresos_CONYUGE
 * @property float $otros_ingresos_total
 * @property float $otros_ingresos_validacion
 * @property float $servicios_lat_titular
 * @property float $servicios_lat_CONYUGE
 * @property float $servicios_lat_total
 * @property float $servicios_lat_validacion
 * @property float $alquiler_titular
 * @property float $alquiler_CONYUGE
 * @property float $alquiler_total
 * @property float $alquiler_validacion
 * @property float $empleados_titular
 * @property float $empleados_CONYUGE
 * @property float $empleados_total
 * @property float $empleados_validacion
 * @property float $gasto_financiero_titular
 * @property float $gasto_financiero_CONYUGE
 * @property float $gasto_financiero_total
 * @property float $gasto_financiero_validacion
 * @property float $gasto_hogar_titular
 * @property float $gasto_hogar_CONYUGE
 * @property float $gasto_hogar_total
 * @property float $gasto_hogar_validacion
 * @property float $utilidad_titular
 * @property float $utilidad_CONYUGE
 * @property float $utilidad_total
 * @property float $utilidad_validacion
 * @property float $cuota_institucion_titular
 * @property float $cuota_institucion_CONYUGE
 * @property float $cuota_institucion_total
 * @property float $cuota_institucion_validacion
 * @property float $utilidad_desp_cuota_titular
 * @property float $utilidad_desp_cuota_CONYUGE
 * @property float $utilidad_desp_cuota_total
 * @property float $utilidad_desp_cuota_validacion
 * @property float $balance_activo_caja
 * @property float $balance_activo_inventario
 * @property float $balance_activo_f
 * @property float $balance_activo_total
 * @property float $balance_pasivo_deudas
 * @property float $balance_patrimonio_capital
 * @property float $balance_patrimonio_utilidad
 * @property float $balance_patrimonio_total
 */
class ResultadoCuantitativa extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'evaluacion_cuantitativa';

    /**
     * @var array
     */
    protected $fillable = ['prestamo_id', 'participacion_cuota_titular', 'participacion_cuota_total', 'participacion_cuota_validacion', 'resultado_eva', 'resultado_sist', 'ratios_endeudamiento', 'ratios_endeudamiento_resultado', 'ratios_margen_neto', 'ratios_margen_neto_resultado', 'ratios_liquidez', 'ratios_liquidez_resultado', 'ratios_solvencia', 'ratios_solvencia_resultado', 'ingresos_ventas_titular', 'ingresos_ventas_CONYUGE', 'ingresos_ventas_total', 'ingresos_ventas_validacion', 'costo_venta_titular', 'costo_venta_CONYUGE', 'consto_venta_total', 'costo_venta_validacion', 'margen_bruto_titular', 'margen_bruto_CONYUGE', 'margen_bruto_total', 'margen_bruto_validacion', 'otros_ingresos_titular', 'otros_ingresos_CONYUGE', 'otros_ingresos_total', 'otros_ingresos_validacion', 'servicios_lat_titular', 'servicios_lat_CONYUGE', 'servicios_lat_total', 'servicios_lat_validacion', 'alquiler_titular', 'alquiler_CONYUGE', 'alquiler_total', 'alquiler_validacion', 'empleados_titular', 'empleados_CONYUGE', 'empleados_total', 'empleados_validacion', 'gasto_financiero_titular', 'gasto_financiero_CONYUGE', 'gasto_financiero_total', 'gasto_financiero_validacion', 'gasto_hogar_titular', 'gasto_hogar_CONYUGE', 'gasto_hogar_total', 'gasto_hogar_validacion', 'utilidad_titular', 'utilidad_CONYUGE', 'utilidad_total', 'utilidad_validacion', 'cuota_institucion_titular', 'cuota_institucion_CONYUGE', 'cuota_institucion_total', 'cuota_institucion_validacion', 'utilidad_desp_cuota_titular', 'utilidad_desp_cuota_CONYUGE', 'utilidad_desp_cuota_total', 'utilidad_desp_cuota_validacion', 'balance_activo_caja', 'balance_activo_inventario', 'balance_activo_f', 'balance_activo_total', 'balance_pasivo_deudas', 'balance_patrimonio_capital', 'balance_patrimonio_utilidad', 'balance_patrimonio_total'];
    public $timestamps=false;
}
