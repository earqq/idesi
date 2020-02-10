<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepresentantesLegalesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'representantes_legales';

    /**
     * Run the migrations.
     * @table representantes_legales
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombres', 100)->nullable()->default(null);
            $table->integer('documento')->nullable()->default(null);
            $table->string('cargo', 20)->nullable()->default(null);
            $table->unsignedInteger('empresa_id');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('ocupacion', 50)->nullable();
            $table->string('telefono', 10)->nullable();
            $table->string('celular', 15)->nullable();
            $table->string('ubicacion_direccion', 100)->nullable();
            $table->string('ubicacion_departamento', 100)->nullable();
            $table->string('ubicacion_provincia', 100)->nullable();
            $table->string('ubicacion_distrito', 100)->nullable();
            $table->string('ubicacion_referencia', 100)->nullable();
            $table->string('tipo_domicilio', 15)->nullable()->default('PROPIA');
            $table->string('poderes', 10)->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->string('estado_civil', 30)->nullable()->default('SOLTERO');

            $table->index(["empresa_id"], 'fk_representantes_juridicos1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('empresa_id', 'fk_representantes_juridicos1_idx')
                ->references('id')->on('empresas')
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
