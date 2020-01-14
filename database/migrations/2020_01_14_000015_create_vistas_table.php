<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVistasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'vistas';

    /**
     * Run the migrations.
     * @table vistas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('imagen', 45)->nullable()->default(null);
            $table->date('fecha')->nullable()->default(null);
            $table->string('hora', 10)->nullable()->default(null);
            $table->string('motivo', 50)->nullable()->default(null);
            $table->string('latitud', 50)->nullable()->default(null);
            $table->string('altitud', 50)->nullable()->default(null);
            $table->char('estado', 1)->nullable()->default(null);
            $table->unsignedInteger('prestamos_id');

            $table->index(["prestamos_id"], 'fk_vistas_prestamos1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('prestamos_id', 'fk_vistas_prestamos1_idx')
                ->references('id')->on('prestamos')
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
