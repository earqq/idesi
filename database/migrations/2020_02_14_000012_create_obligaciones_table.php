<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObligacionesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'obligaciones';

    /**
     * Run the migrations.
     * @table obligaciones
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->decimal('inscripcion', 11, 2)->nullable()->default('0.00');
            $table->decimal('aporte', 11, 2)->nullable()->default('0.00');
            $table->decimal('fondo', 11, 2)->nullable()->default('0.00');
            $table->decimal('fondo_opcional', 11, 2)->nullable()->default('0.00');
            $table->unsignedInteger('cliente_id');

            $table->index(["cliente_id"], 'fk_obligaciones_clientes1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('cliente_id', 'fk_obligaciones_clientes1_idx')
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
