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
            $table->string('nombres', 45)->nullable();
            $table->string('apellidos', 45)->nullable();
            $table->string('estado_civil', 25)->nullable();
            $table->string('ocupacion', 50)->nullable();
            $table->string('telefono', 10)->nullable();
            $table->string('celular', 15)->nullable();
            $table->string('direccion_cliente', 70)->nullable();
            $table->string('direccion_registros', 70)->nullable();
            $table->string('referencia', 50)->nullable();
            $table->string('tipo_domicilio', 30)->nullable();
            $table->string('centro_laboral', 40)->nullable();
            $table->string('direccion_laboral', 100)->nullable();
            $table->unsignedInteger('clientes_id');

            $table->index(["clientes_id"], 'fk_naturals_clientes1_idx');


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
