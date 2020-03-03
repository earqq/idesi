<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCualitativasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'cualitativas';

    /**
     * Run the migrations.
     * @table cualitativas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('prestamo_id');
            $table->string('fuente_ingresos', 200)->nullable();
            $table->string('destino_credito', 200)->nullable();
            $table->text('negocio_ubicacion')->nullable();
            $table->string('negocio_antiguedad', 200)->nullable();
            $table->text('negocio_local')->nullable();
            $table->boolean('negocio_licencia_funcionamiento')->nullable();
            $table->boolean('negocio_mejoras_local')->nullable()->default('0');
            $table->time('horario_atencion_entrada')->nullable();
            $table->time('horario_atencion_salida')->nullable();
            $table->string('colateral', 45)->nullable();
            $table->text('descripcion_colateral')->nullable();
            $table->text('destino_credito_descripcion')->nullable();
            $table->string('vehiculo_marca', 45)->nullable();
            $table->string('vehiculo_modelo', 200)->nullable();
            $table->integer('vechiculo_anio')->nullable();
            $table->string('vehiculo_tipo_servicio_brinda', 200)->nullable();
            $table->boolean('vehiculo_permiso_servicio')->nullable();
            $table->float('precio_educacion_hijos')->nullable();

            $table->index(["prestamo_id"], 'fk_cualitativa_prestamos1_idx');


            $table->foreign('prestamo_id', 'fk_cualitativa_prestamos1_idx')
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
