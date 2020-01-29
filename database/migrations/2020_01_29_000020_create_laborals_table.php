<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboralsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'laborals';

    /**
     * Run the migrations.
     * @table laborals
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('estado_laboral', 15)->nullable()->default(null);
            $table->string('tipo_trabajador', 15)->nullable()->default(null);
            $table->string('especificacion', 45)->nullable()->default(null);
            $table->string('razon_social', 45)->nullable()->default(null);
            $table->string('ingreso_mensual', 25)->nullable()->default(null);
            $table->string('cargo_ocupacion', 20)->nullable()->default(null);
            $table->date('fecha_ingreso')->nullable()->default(null);
            $table->string('giro_negocio', 45)->nullable()->default(null);
            $table->string('direccion', 45)->nullable()->default(null);
            $table->string('numero', 5)->nullable()->default(null);
            $table->string('manzana', 5)->nullable()->default(null);
            $table->string('lote', 5)->nullable()->default(null);
            $table->string('dpto', 5)->nullable()->default(null);
            $table->string('int', 5)->nullable()->default(null);
            $table->string('piso', 5)->nullable()->default(null);
            $table->string('distrito', 45)->nullable()->default(null);
            $table->string('provincia', 45)->nullable()->default(null);
            $table->string('departamento', 45)->nullable()->default(null);
            $table->string('pais', 20)->nullable()->default(null);
            $table->string('referencia', 45)->nullable()->default(null);
            $table->string('telefono', 10)->nullable()->default(null);
            $table->string('celular', 15)->nullable()->default(null);
            $table->string('email', 45)->nullable()->default(null);
            $table->unsignedInteger('naturals_id');

            $table->index(["naturals_id"], 'fk_laborals_naturals1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('naturals_id', 'fk_laborals_naturals1_idx')
                ->references('id')->on('naturals')
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
