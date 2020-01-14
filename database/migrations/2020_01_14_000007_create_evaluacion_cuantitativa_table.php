<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionCuantitativaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'evaluacion_cuantitativa';

    /**
     * Run the migrations.
     * @table evaluacion_cuantitativa
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('prestamo_id');
            $table->decimal('participacion_cuota_titular', 11, 2)->nullable()->default('0.00');
            $table->decimal('participacion_cuota_total', 11, 2)->nullable()->default(null);
            $table->decimal('participacion_cuota_validacion', 11, 2)->nullable()->default('0.00');
            $table->string('resultado_eva', 45)->nullable()->default(null);
            $table->string('resultado_sist', 45)->nullable()->default(null);
            $table->decimal('ratios_endeudamiento', 11, 2)->nullable()->default('0.00');
            $table->string('ratios_endeudamiento_resultado', 45)->nullable()->default(null);
            $table->decimal('ratios_margen_neto', 11, 2)->nullable()->default('0.00');
            $table->string('ratios_margen_neto_resultado', 45)->nullable()->default(null);
            $table->decimal('ratios_liquidez', 11, 2)->nullable()->default(null);
            $table->string('ratios_liquidez_resultado', 45)->nullable()->default(null);
            $table->decimal('ratios_solvencia', 11, 2)->nullable()->default('0.00');
            $table->string('ratios_solvencia_resultado', 45)->nullable()->default(null);
            $table->decimal('ingresos_ventas_titular', 11, 2)->nullable()->default('0.00');
            $table->decimal('ingresos_ventas_conyuge', 11, 2)->nullable()->default('0.00');
            $table->decimal('ingresos_ventas_total', 11, 2)->nullable()->default('0.00');
            $table->decimal('ingresos_ventas_validacion', 11, 2)->nullable()->default('0.00');
            $table->decimal('costo_venta_titular', 11, 2)->nullable()->default('0.00');
            $table->decimal('costo_venta_conyuge', 11, 2)->nullable()->default('0.00');
            $table->decimal('costo_venta_total', 11, 2)->nullable()->default('0.00');
            $table->decimal('costo_venta_validacion', 11, 2)->nullable()->default('0.00');
            $table->decimal('margen_bruto_titular', 11, 2)->nullable()->default('0.00');
            $table->decimal('margen_bruto_conyuge', 11, 2)->nullable()->default('0.00');
            $table->decimal('margen_bruto_total', 11, 2)->nullable()->default('0.00');
            $table->decimal('margen_bruto_validacion', 11, 2)->nullable()->default('0.00');
            $table->decimal('otros_ingresos_titular', 11, 2)->nullable()->default('0.00');
            $table->decimal('otros_ingresos_conyuge', 11, 2)->nullable()->default('0.00');
            $table->decimal('otros_ingresos_total', 11, 2)->nullable()->default('0.00');
            $table->decimal('otros_ingresos_validacion', 11, 2)->nullable()->default('0.00');
            $table->decimal('servicios_lat_titular', 11, 2)->nullable()->default('0.00');
            $table->decimal('servicios_lat_conyuge', 11, 2)->nullable()->default('0.00');
            $table->decimal('servicios_lat_total', 11, 2)->nullable()->default('0.00');
            $table->decimal('servicios_lat_validacion', 11, 2)->nullable()->default('0.00');
            $table->decimal('alquiler_titular', 11, 2)->nullable()->default('0.00');
            $table->decimal('alquiler_conyuge', 11, 2)->nullable()->default('0.00');
            $table->decimal('alquiler_total', 11, 2)->nullable()->default('0.00');
            $table->decimal('alquiler_validacion', 11, 2)->nullable()->default('0.00');
            $table->decimal('empleados_titular', 11, 2)->nullable()->default('0.00');
            $table->decimal('empleados_conyuge', 11, 2)->nullable()->default('0.00');
            $table->decimal('empleados_total', 11, 2)->nullable()->default('0.00');
            $table->decimal('empleados_validacion', 11, 2)->nullable()->default('0.00');
            $table->decimal('gasto_financiero_titular', 11, 2)->nullable()->default('0.00');
            $table->decimal('gasto_financiero_conyuge', 11, 2)->nullable()->default('0.00');
            $table->decimal('gasto_financiero_total', 11, 2)->nullable()->default('0.00');
            $table->decimal('gasto_financiero_validacion', 11, 2)->nullable()->default('0.00');
            $table->decimal('gasto_hogar_titular', 11, 2)->nullable()->default('0.00');
            $table->decimal('gasto_hogar_conyuge', 11, 2)->nullable()->default('0.00');
            $table->decimal('gasto_hogar_total', 11, 2)->nullable()->default('0.00');
            $table->decimal('gasto_hogar_validacion', 11, 2)->nullable()->default('0.00');
            $table->decimal('utilidad_titular', 11, 2)->nullable()->default('0.00');
            $table->decimal('utilidad_conyuge', 11, 2)->nullable()->default('0.00');
            $table->decimal('utilidad_total', 11, 2)->nullable()->default('0.00');
            $table->decimal('utilidad_validacion', 11, 2)->nullable()->default('0.00');
            $table->decimal('cuota_institucion_titular', 11, 2)->nullable()->default('0.00');
            $table->decimal('cuota_institucion_conyuge', 11, 2)->nullable()->default('0.00');
            $table->decimal('cuota_institucion_total', 11, 2)->nullable()->default('0.00');
            $table->decimal('cuota_institucion_validacion', 11, 2)->nullable()->default('0.00');
            $table->decimal('utilidad_desp_cuota_titular', 11, 2)->nullable()->default('0.00');
            $table->decimal('utilidad_desp_cuota_conyuge', 11, 2)->nullable()->default('0.00');
            $table->decimal('utilidad_desp_cuota_total', 11, 2)->nullable()->default('0.00');
            $table->decimal('utilidad_desp_cuota_validacion', 11, 2)->nullable()->default('0.00');
            $table->decimal('balance_activo_caja', 11, 2)->nullable()->default('0.00');
            $table->decimal('balance_activo_inventario', 11, 2)->nullable()->default('0.00');
            $table->decimal('balance_activo_f', 11, 2)->nullable()->default('0.00');
            $table->decimal('balance_activo_total', 11, 2)->nullable()->default('0.00');
            $table->decimal('balance_pasivo_deudas', 11, 2)->nullable()->default('0.00');
            $table->decimal('balance_patrimonio_capital', 11, 2)->nullable()->default('0.00');
            $table->decimal('balance_patrimonio_utilidad', 11, 2)->nullable()->default('0.00');
            $table->decimal('balance_patrimonio_total', 11, 2)->nullable()->default('0.00');
            $table->decimal('gasto_financiero_personal_titular', 11, 2)->nullable()->default('0.00');
            $table->decimal('gasto_financiero_personal_conyuge', 11, 2)->nullable()->default('0.00');
            $table->decimal('gasto_financiero_personal_total', 11, 2)->nullable()->default('0.00');
            $table->decimal('gasto_financiero_personal_validacion', 11, 2)->nullable()->default('0.00');
            $table->decimal('fc_diario_minimo_ingreso', 11, 2)->nullable()->default('0.00');
            $table->decimal('fc_diario_cuota', 11, 2)->nullable()->default('0.00');
            $table->decimal('fc_diario_disponible_diario', 11, 2)->nullable()->default('0.00');
            $table->decimal('fc_diario_participacion_cuota', 11, 2)->nullable()->default('0.00');
            $table->string('fc_diario_resultado', 200)->nullable();
            $table->decimal('fc_semanal_minimo_ingreso', 11, 2)->nullable()->default('0.00');
            $table->decimal('fc_semanal_cuota', 11, 2)->nullable()->default('0.00');
            $table->decimal('fc_semanal_participacion_cuota', 11, 2)->nullable()->default('0.00');
            $table->string('fc_semanal_resultado', 200)->nullable();
            $table->decimal('fc_semanal_disponible_semana', 11, 2)->nullable()->default('0.00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
