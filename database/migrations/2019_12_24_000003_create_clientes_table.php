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
    public $tableName = 'clientes';

    /**
     * Run the migrations.
     * @table clientes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tipo_documento', 10)->nullable()->default(null);
            $table->string('documento', 11)->nullable()->default(null);
            $table->string('codigo', 10)->nullable()->default(null);
            $table->string('tipo_cliente', 5)->nullable()->default(null);
            $table->string('numero_registro', 15)->nullable()->default(null);
            $table->string('agencia', 50)->nullable()->default(null);
            $table->string('pais', 15)->nullable()->default(null);
            $table->string('departamento', 45)->nullable()->default(null);
            $table->string('provincia', 45)->nullable()->default(null);
            $table->string('distrito', 45)->nullable()->default(null);
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
       Schema::dropIfExists($this->tableName);
     }
}
