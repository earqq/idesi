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
            $table->decimal('participacion_cuota_titular')->nullable()->default(null);
            $table->decimal('participacion_cuota_total')->nullable()->default(null);
            $table->decimal('participacion_cuota_validacion')->nullable()->default(null);
            $table->string('resultado_eva', 45)->nullable()->default(null);
            $table->string('resultado_sist', 45)->nullable()->default(null);
            $table->decimal('ratios_endeudamiento')->nullable()->default(null);
            $table->string('ratios_endeudamiento_resultado', 45)->nullable()->default(null);
            $table->decimal('ratios_margen_neto')->nullable()->default(null);
            $table->string('ratios_margen_neto_resultado', 45)->nullable()->default(null);
            $table->decimal('ratios_liquidez')->nullable()->default(null);
            $table->string('ratios_liquidez_resultado', 45)->nullable()->default(null);
            $table->decimal('ratios_solvencia')->nullable()->default(null);
            $table->string('ratios_solvencia_resultado', 45)->nullable()->default(null);
            $table->decimal('ingresos_ventas_titular')->nullable();
            $table->decimal('ingresos_ventas_conyuge')->nullable();
            $table->decimal('ingresos_ventas_total')->nullable();
            $table->decimal('ingresos_ventas_validacion')->nullable();
            $table->decimal('costo_venta_titular')->nullable();
            $table->decimal('costo_venta_conyuge')->nullable();
            $table->decimal('consto_venta_total')->nullable();
            $table->decimal('costo_venta_validacion')->nullable();
            $table->decimal('margen_bruto_titular')->nullable();
            $table->decimal('margen_bruto_conyuge')->nullable();
            $table->decimal('margen_bruto_total')->nullable();
            $table->decimal('margen_bruto_validacion')->nullable();
            $table->decimal('otros_ingresos_titular')->nullable();
            $table->decimal('otros_ingresos_conyuge')->nullable();
            $table->decimal('otros_ingresos_total')->nullable();
            $table->decimal('otros_ingresos_validacion')->nullable();
            $table->decimal('servicios_lat_titular')->nullable();
            $table->decimal('servicios_lat_conyuge')->nullable();
            $table->decimal('servicios_lat_total')->nullable();
            $table->decimal('servicios_lat_validacion')->nullable();
            $table->decimal('alquiler_titular')->nullable();
            $table->decimal('alquiler_conyuge')->nullable();
            $table->decimal('alquiler_total')->nullable();
            $table->decimal('alquiler_validacion')->nullable();
            $table->decimal('empleados_titular')->nullable();
            $table->decimal('empleados_conyuge')->nullable();
            $table->decimal('empleados_total')->nullable();
            $table->decimal('empleados_validacion')->nullable();
            $table->decimal('gasto_financiero_titular')->nullable();
            $table->decimal('gasto_financiero_conyuge')->nullable();
            $table->decimal('gasto_financiero_total')->nullable();
            $table->decimal('gasto_financiero_validacion')->nullable();
            $table->decimal('gasto_hogar_titular')->nullable();
            $table->decimal('gasto_hogar_conyuge')->nullable();
            $table->decimal('gasto_hogar_total')->nullable();
            $table->decimal('gasto_hogar_validacion')->nullable();
            $table->decimal('utilidad_titular')->nullable();
            $table->decimal('utilidad_conyuge')->nullable();
            $table->decimal('utilidad_total')->nullable();
            $table->decimal('utilidad_validacion')->nullable();
            $table->decimal('cuota_institucion_titular')->nullable();
            $table->decimal('cuota_institucion_conyuge')->nullable();
            $table->decimal('cuota_institucion_total')->nullable();
            $table->decimal('cuota_institucion_validacion')->nullable();
            $table->decimal('utilidad_desp_cuota_titular')->nullable();
            $table->decimal('utilidad_desp_cuota_conyuge')->nullable();
            $table->decimal('utilidad_desp_cuota_total')->nullable();
            $table->decimal('utilidad_desp_cuota_validacion')->nullable();
            $table->decimal('balance_activo_caja')->nullable();
            $table->decimal('balance_activo_inventario')->nullable();
            $table->decimal('balance_activo_f')->nullable();
            $table->decimal('balance_activo_total')->nullable();
            $table->decimal('balance_pasivo_deudas')->nullable();
            $table->decimal('balance_patrimonio_capital')->nullable();
            $table->decimal('balance_patrimonio_utilidad')->nullable();
            $table->decimal('balance_patrimonio_total')->nullable();
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
