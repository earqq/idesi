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
            $table->string('razon_social', 50)->nullable();
            $table->string('tipo_empresa', 30)->nullable();
            $table->date('fecha_creacion')->nullable();
            $table->string('empresa_direccion', 50)->nullable();
            $table->string('empresa_referencia', 50)->nullable();
            $table->integer('representante_doc')->nullable();
            $table->string('representante_nombres', 30)->nullable();
            $table->string('representante_apellidos', 30)->nullable();
            $table->string('representante_direccion', 50)->nullable();
            $table->string('representante_referencia', 50)->nullable();
            $table->string('registros_direccion', 70)->nullable();

            $table->index(["clientes_id"], 'fk_juridicos_clientes1_idx');


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
