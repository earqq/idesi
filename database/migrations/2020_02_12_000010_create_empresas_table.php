<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'empresas';

    /**
     * Run the migrations.
     * @table empresas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'EXAMPLE';
            $table->increments('id');
            $table->string('razon_social', 200)->nullable()->default(null);
            $table->string('nombre_comercial', 200)->nullable()->default(null);
            $table->string('actividad_principal', 200)->nullable()->default(null);
            $table->integer('partida_registral')->nullable()->default(null);
            $table->string('oficina_principal', 100)->nullable()->default(null);
            $table->string('tipo_negocio', 10)->nullable()->default(null);
            $table->date('fecha_constitucion')->nullable()->default(null);
            $table->unsignedInteger('cliente_id');

            $table->index(["cliente_id"], 'fk_empresas_clientes1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('cliente_id', 'fk_empresas_clientes1_idx')
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
