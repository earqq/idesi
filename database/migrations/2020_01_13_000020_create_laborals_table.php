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
    public $set_schema_table = 'laborals';

    /**
     * Run the migrations.
     * @table laborals
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('estado_laboral', 45)->nullable()->default(null);
            $table->string('tipo_trabajador', 45)->nullable()->default(null);
            $table->string('especificacion', 45)->nullable()->default(null);
            $table->string('razon_social', 45)->nullable()->default(null);
            $table->double('ingreso_mensual')->nullable()->default(null);
            $table->string('cargo_ocupacion', 45)->nullable()->default(null);
            $table->date('fecha_ingreso')->nullable()->default(null);
            $table->string('giro_negocio', 45)->nullable()->default(null);
            $table->string('direccion', 45)->nullable()->default(null);
            $table->string('numero', 45)->nullable()->default(null);
            $table->string('manzana', 45)->nullable()->default(null);
            $table->string('lote', 5)->nullable()->default(null);
            $table->string('dpto', 5)->nullable()->default(null);
            $table->string('int', 5)->nullable()->default(null);
            $table->string('piso', 5)->nullable()->default(null);
            $table->string('distrito', 45)->nullable()->default(null);
            $table->string('provincia', 45)->nullable()->default(null);
            $table->string('departamento', 45)->nullable()->default(null);
            $table->string('pais', 45)->nullable()->default(null);
            $table->string('referencia', 45)->nullable()->default(null);
            $table->string('telefono', 15)->nullable()->default(null);
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
       Schema::dropIfExists($this->set_schema_table);
     }
}
