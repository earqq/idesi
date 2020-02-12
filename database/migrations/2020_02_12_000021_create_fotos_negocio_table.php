<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotosNegocioTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'fotos_negocio';

    /**
     * Run the migrations.
     * @table fotos_negocio
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('imagen', 200)->nullable()->default(null);
            $table->date('fecha')->nullable()->default(null);
            $table->time('hora')->nullable()->default(null);
            $table->string('latitud', 50)->nullable()->default(null);
            $table->string('longitud', 50)->nullable()->default(null);
            $table->unsignedInteger('prestamo_id');

            $table->index(["prestamo_id"], 'fk_vistas_prestamos1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('prestamo_id', 'fk_vistas_prestamos1_idx')
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
