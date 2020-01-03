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
            $table->double('participacion_cuota_titular')->nullable()->default(null);
            $table->double('participacion_cuota_total')->nullable()->default(null);
            $table->double('participacion_cuota_validacion')->nullable()->default(null);
            $table->string('resultado_eva', 45)->nullable()->default(null);
            $table->string('resultado_sist', 45)->nullable()->default(null);
            $table->double('ratios_endeudamiento')->nullable()->default(null);
            $table->string('ratios_endeudamiento_resultado', 45)->nullable()->default(null);
            $table->double('ratios_margen_neto')->nullable()->default(null);
            $table->string('ratios_margen_neto_resultado', 45)->nullable()->default(null);
            $table->double('ratios_liquidez')->nullable()->default(null);
            $table->string('ratios_liquidez_resultado', 45)->nullable()->default(null);
            $table->double('ratios_solvencia')->nullable()->default(null);
            $table->string('ratios_solvencia_resultado', 45)->nullable()->default(null);
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
