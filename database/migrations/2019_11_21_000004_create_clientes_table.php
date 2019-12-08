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
            $table->string('documento', 8)->nullable();
            $table->string('codigo', 10)->nullable();
            $table->string('tipo_cliente', 5)->nullable();
            $table->char('estado')->default('1');
            $table->integer('departamentos_id')->nullable()->default(null);
            $table->integer('distritos_id')->nullable()->default(null);
            $table->integer('provincias_id')->nullable()->default(null);

            $table->index(["departamentos_id"], 'fk_clientes_departamentos1_idx');

            $table->index(["distritos_id"], 'fk_clientes_distritos1_idx');

            $table->index(["provincias_id"], 'fk_clientes_provincias1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


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
