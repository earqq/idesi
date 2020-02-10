<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'trabajos';

    /**
     * Run the migrations.
     * @table trabajos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('estado_laboral', 15)->nullable();
            $table->string('tipo_trabajador', 15)->nullable();
            $table->string('especificacion', 45)->nullable();
            $table->string('empresa_razon_social', 200)->nullable();
            $table->string('ingreso_mensual', 25)->nullable();
            $table->string('cargo_ocupacion', 20)->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->string('empresa_giro_negocio', 200)->nullable();
            $table->string('empresa_direccion', 100)->nullable();
            $table->string('empresa_numero', 5)->nullable();
            $table->string('empresa_manzana', 5)->nullable();
            $table->integer('empresa_lote')->nullable();
            $table->integer('empresa_dpto')->nullable();
            $table->integer('empresa_int')->nullable();
            $table->integer('empresa_piso')->nullable();
            $table->string('empresa_distrito', 100)->nullable();
            $table->string('empresa_provincia', 100)->nullable();
            $table->string('empresa_departamento', 100)->nullable();
            $table->string('empresa_pais', 20)->nullable();
            $table->string('empresa_referencia', 50)->nullable();
            $table->string('empresa_telefono', 10)->nullable();
            $table->string('empresa_celular', 15)->nullable();
            $table->string('empresa_email', 45)->nullable();
            $table->unsignedInteger('persona_id');

            $table->index(["persona_id"], 'fk_laborals_naturals1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('persona_id', 'fk_laborals_naturals1_idx')
                ->references('id')->on('personas')
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
