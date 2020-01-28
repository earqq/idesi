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
            $table->unsignedInteger('users_id');
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

            $table->index(["users_id"], 'fk_clientes_users1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('users_id', 'fk_clientes_users1_idx')
                ->references('id')->on('users')
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
