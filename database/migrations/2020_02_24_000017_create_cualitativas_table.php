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
            $table->text('ubicacion_negocio')->nullable();
            $table->integer('antiguedad')->nullable();
            $table->text('local')->nullable();
            $table->string('licencia_funcionamiento', 50)->nullable();
            $table->boolean('mejoras_local')->nullable()->default('0');
            $table->time('horario_atencion_entrada')->nullable();
            $table->time('horario_atencion_salida')->nullable();
            $table->string('colateral', 45)->nullable();
            $table->text('descripcion_colateral')->nullable();
            $table->text('destino_credito_descripcion')->nullable();

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
