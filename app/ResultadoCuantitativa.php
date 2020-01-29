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
 * @property float $ingresos_ventas_conyuge
 * @property float $ingresos_ventas_total
 * @property float $ingresos_ventas_validacion
 * @property float $costo_venta_titular
 * @property float $costo_venta_conyuge
 * @property float $consto_venta_total
 * @property float $costo_venta_validacion
 * @property float $margen_bruto_titular
 * @property float $margen_bruto_conyuge
 * @property float $margen_bruto_total
 * @property float $margen_bruto_validacion
 * @property float $otros_ingresos_titular
 * @property float $otros_ingresos_conyuge
 * @property float $otros_ingresos_total
 * @property float $otros_ingresos_validacion
 * @property float $servicios_lat_titular
 * @property float $servicios_lat_conyuge
 * @property float $servicios_lat_total
 * @property float $servicios_lat_validacion
 * @property float $alquiler_titular
 * @property float $alquiler_conyuge
 * @property float $alquiler_total
 * @property float $alquiler_validacion
 * @property float $empleados_titular
 * @property float $empleados_conyuge
 * @property float $empleados_total
 * @property float $empleados_validacion
 * @property float $gasto_financiero_titular
 * @property float $gasto_financiero_conyuge
 * @property float $gasto_financiero_total
 * @property float $gasto_financiero_validacion
 * @property float $gasto_hogar_titular
 * @property float $gasto_hogar_conyuge
 * @property float $gasto_hogar_total
 * @property float $gasto_hogar_validacion
 * @property float $utilidad_titular
 * @property float $utilidad_conyuge
 * @property float $utilidad_total
 * @property float $utilidad_validacion
 * @property float $cuota_institucion_titular
 * @property float $cuota_institucion_conyuge
 * @property float $cuota_institucion_total
 * @property float $cuota_institucion_validacion
 * @property float $utilidad_desp_cuota_titular
 * @property float $utilidad_desp_cuota_conyuge
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
    public $timestamps=false;
}
