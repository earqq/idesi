<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNaturalsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'naturals';

    /**
     * Run the migrations.
     * @table naturals
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('clientes_id');
            $table->string('nombres', 45)->nullable()->default(null);
            $table->string('apellidos', 45)->nullable()->default(null);
            $table->date('nacimiento')->nullable()->default(null);
            $table->string('estado_civil', 25)->nullable()->default(null);
            $table->string('ocupacion', 50)->nullable()->default(null);
            $table->string('telefono', 10)->nullable()->default(null);
            $table->string('celular', 15)->nullable()->default(null);
            $table->string('direccion_cliente', 70)->nullable()->default(null);
            $table->string('direccion_registros', 70)->nullable()->default(null);
            $table->string('referencia', 50)->nullable()->default(null);
            $table->string('tipo_domicilio', 30)->nullable()->default(null);
            $table->string('centro_laboral', 40)->nullable()->default(null);
            $table->string('direccion_laboral', 100)->nullable()->default(null);
            $table->string('genero', 10)->nullable();
            $table->string('grado_instruccion', 10)->nullable();
            $table->string('numero', 45)->nullable();
            $table->string('manzana', 45)->nullable();
            $table->string('dpto', 45)->nullable();
            $table->string('int', 45)->nullable();
            $table->string('piso', 45)->nullable();
            $table->string('domicilio_distrito', 45)->nullable();
            $table->string('domicilio_provincia', 45)->nullable();
            $table->string('domicilio_departamento', 45)->nullable();
            $table->string('correo', 45)->nullable();

            $table->index(["clientes_id"], 'fk_naturals_clientes1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('clientes_id', 'fk_naturals_clientes1_idx')
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
       Schema::dropIfExists($this->set_schema_table);
     }
}
