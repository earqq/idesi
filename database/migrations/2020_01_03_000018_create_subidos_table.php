<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubidosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'subidos';

    /**
     * Run the migrations.
     * @table subidos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('inscripcion_socio')->nullable()->default('0');
            $table->integer('solicitud_credito')->nullable()->default('0');
            $table->integer('reporte_de_central')->nullable()->default('0');
            $table->integer('evaluacion_cualitativa')->nullable()->default('0');
            $table->integer('evaluacion_cuantitativa')->nullable()->default('0');
            $table->integer('copia_dni')->nullable()->default('0');
            $table->integer('recibo_agua_casa')->nullable()->default('0');
            $table->integer('recibo_luz_casa')->nullable()->default('0');
            $table->integer('titulo_casa')->nullable()->default('0');
            $table->integer('contrato_alquiler_casa')->nullable()->default('0');
            $table->integer('foto_casa')->nullable()->default('0');
            $table->integer('recibo_agua_negocio')->nullable()->default('0');
            $table->integer('recibo_luz_negocio')->nullable()->default('0');
            $table->integer('ubicacion_negocio')->nullable()->default('0');
            $table->integer('contrato_alquiler_negocio')->nullable()->default('0');
            $table->integer('fotos_negocio')->nullable()->default('0');
            $table->integer('boleta_compra')->nullable()->default('0');
            $table->integer('boleta_venta')->nullable()->default('0');
            $table->integer('factura_compra')->nullable()->default('0');
            $table->integer('factura_venta')->nullable()->default('0');
            $table->unsignedInteger('prestamos_id');

            $table->index(["prestamos_id"], 'fk_subidos_prestamos1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('prestamos_id', 'fk_subidos_prestamos1_idx')
                ->references('id')->on('prestamos')
                ->onDelete('no action')
                ->onUpdate('no action');
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
