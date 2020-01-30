<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'generals';

    /**
     * Run the migrations.
     * @table generals
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('clientes_aceptado')->nullable()->default('0');
            $table->integer('clientes_rechazados')->nullable()->default('0');
            $table->integer('clientes_pendientes')->nullable()->default('0');
            $table->integer('prestamos_aceptados')->nullable()->default('0');
            $table->integer('prestamos_rechazados')->nullable()->default('0');
            $table->integer('prestamos_observaods')->nullable()->default('0');
            $table->unsignedInteger('users_id');

            $table->index(["users_id"], 'fk_generals_users1_idx');


            $table->foreign('users_id', 'fk_generals_users1_idx')
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
