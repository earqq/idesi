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
    public $set_schema_table = 'juridicos';

    /**
     * Run the migrations.
     * @table juridicos
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
            $table->string('razon_social', 50)->nullable()->default(null);
            $table->string('nombre_comercial', 60)->nullable();
            $table->string('actividad_principal', 50)->nullable();
            $table->integer('partida_gesitral')->nullable();
            $table->string('oficina_registral', 30)->nullable();
            $table->string('tipo_negocio', 10)->nullable();
            $table->string('dirección', 50)->nullable();
            $table->string('numero', 45)->nullable();
            $table->string('manzana', 5)->nullable();
            $table->string('lote', 5)->nullable();
            $table->string('pdto', 5)->nullable();
            $table->string('int', 5)->nullable();
            $table->string('piso', 5)->nullable();
            $table->string('telefono', 15)->nullable();
            $table->string('celular', 15)->nullable();
            $table->string('email', 45)->nullable();

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
       Schema::dropIfExists($this->set_schema_table);
     }
}
