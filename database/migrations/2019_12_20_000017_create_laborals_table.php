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
            $table->string('estado_laboral', 45)->nullable();
            $table->string('tipo_trabajador', 45)->nullable();
            $table->string('razon_social', 45)->nullable();
            $table->double('ingreso_mensual')->nullable();
            $table->string('cargo_ocupacion', 45)->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->string('giro_negocio', 45)->nullable();
            $table->string('direccion', 45)->nullable();
            $table->string('numero', 45)->nullable();
            $table->string('manzana', 45)->nullable();
            $table->string('lote', 45)->nullable();
            $table->string('dpto', 45)->nullable();
            $table->string('int', 45)->nullable();
            $table->string('piso', 45)->nullable();
            $table->string('distrito', 45)->nullable();
            $table->string('provincia', 45)->nullable();
            $table->string('departamento', 45)->nullable();
            $table->string('pais', 45)->nullable();
            $table->string('referencia', 45)->nullable();
            $table->string('telefono', 45)->nullable();
            $table->string('celular', 45)->nullable();
            $table->unsignedInteger('naturals_id');
            $table->softDeletes();

            $table->timestamps();
            
            $table->index(["naturals_id"], 'fk_laborals_naturals1_idx');


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
