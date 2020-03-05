<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeclaracionesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'declaraciones';

    /**
     * Run the migrations.
     * @table declaraciones
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('uif')->nullable()->default(null);
            $table->boolean('pep')->nullable()->default(null);
            $table->text('observaciones')->nullable()->default(null);
            $table->unsignedInteger('cliente_id');

            $table->index(["cliente_id"], 'fk_declaraciones_clientes1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('cliente_id', 'fk_declaraciones_clientes1_idx')
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
