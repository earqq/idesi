<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'personas';

    /**
     * Run the migrations.
     * @table personas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('cliente_id');
            $table->string('nombres', 100)->nullable()->default(null);
            $table->string('apellidos', 100)->nullable()->default(null);
            $table->date('fecha_nacimiento')->nullable()->default(null);
            $table->string('estado_civil', 25)->nullable()->default(null);
            $table->string('ocupacion', 50)->nullable()->default(null);
            $table->string('tipo_domicilio', 30)->nullable()->default(null);
            $table->string('centro_laboral', 40)->nullable()->default(null);
            $table->string('direccion_laboral', 100)->nullable()->default(null);
            $table->string('genero', 10)->nullable()->default(null);
            $table->string('grado_instruccion', 10)->nullable()->default(null);
            $table->string('estado_trabajo', 15)->nullable();
            $table->string('trabajo_especificacion', 45)->nullable();
            $table->string('nacimiento_departamento', 100)->nullable();
            $table->string('nacimiento_provincia', 100)->nullable();
            $table->string('nacimiento_distrito', 100)->nullable();

            $table->index(["cliente_id"], 'fk_naturals_clientes1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('cliente_id', 'fk_naturals_clientes1_idx')
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
