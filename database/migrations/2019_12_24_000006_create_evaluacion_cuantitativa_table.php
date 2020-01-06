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
            $table->float('participacion_cuota_titular')->nullable();
            $table->float('participacion_cuota_total')->nullable();
            $table->float('participacion_cuota_validacion')->nullable();
            $table->string('resultado_eva', 45)->nullable();
            $table->string('resultado_sist', 45)->nullable();
            $table->float('ratios_endeudamiento')->nullable();
            $table->string('ratios_endeudamiento_resultado', 45)->nullable();
            $table->float('ratios_margen_neto')->nullable();
            $table->string('ratios_margen_neto_resultado', 45)->nullable();
            $table->float('ratios_liquidez')->nullable();
            $table->string('ratios_liquidez_resultado', 45)->nullable();
            $table->float('ratios_solvencia')->nullable();
            $table->string('ratios_solvencia_resultado', 45)->nullable();
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
