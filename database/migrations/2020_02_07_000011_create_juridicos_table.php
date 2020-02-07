<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuridicosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'juridicos';

    /**
     * Run the migrations.
     * @table juridicos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('clientes_id');
            $table->string('razon_social', 200)->nullable()->default(null);
            $table->string('nombre_comercial', 200)->nullable()->default(null);
            $table->string('actividad_principal', 200)->nullable()->default(null);
            $table->integer('partida_registral')->nullable()->default(null);
            $table->string('oficina_principal', 100)->nullable()->default(null);
            $table->string('tipo_negocio', 10)->nullable()->default(null);
            $table->date('fecha_constitucion')->nullable()->default(null);
            $table->string('direccion')->nullable()->default(null);
            $table->string('numero', 5)->nullable()->default(null);
            $table->string('manzana', 5)->nullable()->default(null);
            $table->string('lote', 5)->nullable()->default(null);
            $table->string('pdto', 5)->nullable()->default(null);
            $table->string('int', 5)->nullable()->default(null);
            $table->string('piso', 5)->nullable()->default(null);
            $table->string('referencia', 45)->nullable()->default(null);
            $table->string('telefono', 15)->nullable()->default(null);
            $table->string('celular', 15)->nullable()->default(null);
            $table->string('email', 45)->nullable()->default(null);
            $table->string('nombres_representante', 60)->nullable()->default(null);
            $table->string('documento_representante', 10)->nullable()->default(null);
            $table->date('nacimiento_representante')->nullable()->default(null);
            $table->string('estado_civil_representante', 25)->nullable()->default(null);
            $table->string('ocupacion_representante', 10)->nullable()->default(null);
            $table->string('telefono_representante', 10)->nullable()->default(null);
            $table->string('celular_representante', 15)->nullable()->default(null);
            $table->string('direccion_representante', 191)->nullable()->default(null);
            $table->string('distrito_representante', 25)->nullable()->default(null);
            $table->string('provincia_representante', 25)->nullable()->default(null);
            $table->string('departamento_representante', 25)->nullable()->default(null);
            $table->string('referencia_representante', 20)->nullable()->default(null);
            $table->string('tipo_domicilio_representante', 25)->nullable()->default(null);
            $table->string('poderes_representante', 10)->nullable()->default(null);
            $table->date('fecha_inicio_representante')->nullable()->default(null);

            $table->index(["clientes_id"], 'fk_juridicos_clientes1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('clientes_id', 'fk_juridicos_clientes1_idx')
                ->references('id')->on('clientes')
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