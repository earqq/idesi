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
            $table->string('tipo_documento', 10)->nullable()->default(null);
            $table->string('documento', 15)->nullable()->default(null);
            $table->string('codigo', 10)->nullable()->default(null);
            $table->string('tipo_cliente', 5)->nullable()->default(null);
            $table->string('numero_registro', 15)->nullable()->default(null);
            $table->string('agencia', 50)->nullable()->default(null);
            $table->string('pais', 15)->nullable();
            $table->string('departamento', 45)->nullable();
            $table->string('provincia', 45)->nullable();
            $table->string('distrito', 45)->nullable();
            $table->char('estado', 1)->default('1');
            $table->softDeletes();
            $table->nullableTimestamps();
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
