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
            $table->unsignedInteger('user_id');
            $table->string('tipo_documento', 10)->nullable()->default(null);
            $table->string('documento', 11);
            $table->string('codigo', 10)->nullable()->default(null);
            $table->integer('tipo_cliente')->nullable()->default(null);
            $table->string('pais', 20)->nullable()->default(null);
            $table->string('ubicacion_departamento', 100)->nullable()->default(null);
            $table->string('ubicacion_provincia', 100)->nullable()->default(null);
            $table->string('ubicacion_distrito', 100)->nullable()->default(null);
            $table->integer('estado')->nullable();
            $table->string('ubicacion_direccion_declarada', 200)->nullable();
            $table->string('ubicacion_referencia', 50)->nullable();
            $table->string('ubicacion_direccion_sistema', 200)->nullable();
            $table->string('telefono', 10)->nullable();
            $table->string('celular', 15)->nullable();
            $table->string('email', 50)->nullable();

            $table->index(["user_id"], 'fk_clientes_users1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('user_id', 'fk_clientes_users1_idx')
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
       Schema::dropIfExists($this->tableName);
     }
}
