<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'clientes';

    /**
     * Run the migrations.
     * @table clientes
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('documento')->nullable();
            $table->string('nombres', 50)->nullable();
            $table->string('apellidos', 50)->nullable();
            $table->date('nacimiento')->nullable();
            $table->string('estado_civil', 15)->nullable();
            $table->string('ocupacion', 50)->nullable();
            $table->string('telefono', 10)->nullable();
            $table->string('celular', 15)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->string('referencia', 100)->nullable();
            $table->string('tipo_domicilio', 30)->nullable();
            $table->string('centro_laboral', 40)->nullable();
            $table->string('direccion_laboral', 100)->nullable();
            $table->integer('documento_conyugue')->nullable();
            $table->string('nombres_conyugue', 50)->nullable();
            $table->string('apellidos_conyugue', 50)->nullable();
            $table->date('nacimiento_conyugue')->nullable();
            $table->string('estado_civil_conyugue', 15)->nullable();
            $table->string('ocupacion_conyugue', 50)->nullable();
            $table->string('telefono_conyugue', 10)->nullable();
            $table->string('celular_conyugue', 15)->nullable();
            $table->string('centro_laboral_conyugue', 40)->nullable();
            $table->string('direccion_laboral_conyugue', 100)->nullable();
            $table->integer('departamentos_id')->nullable();
            $table->integer('distritos_id')->nullable();
            $table->integer('provincias_id')->nullable();

            $table->softDeletes();

            $table->timestamps();

            $table->index(["departamentos_id"], 'fk_clientes_departamentos1_idx');

            $table->index(["distritos_id"], 'fk_clientes_distritos1_idx');

            $table->index(["provincias_id"], 'fk_clientes_provincias1_idx');


            $table->foreign('departamentos_id', 'fk_clientes_departamentos1_idx')
                ->references('id')->on('departamentos')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('distritos_id', 'fk_clientes_distritos1_idx')
                ->references('id')->on('distritos')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('provincias_id', 'fk_clientes_provincias1_idx')
                ->references('id')->on('provincias')
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
