<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGarantiasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'garantias';

    /**
     * Run the migrations.
     * @table garantias
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('bien_garantia', 50)->nullable()->default(null);
            $table->boolean('inscripcion')->nullable()->default(null);
            $table->boolean('declaracion_jurada')->nullable()->default(null);
            $table->unsignedInteger('prestamo_id');
            $table->string('marca', 100)->nullable();
            $table->string('modelo', 100)->nullable();
            $table->date('anio_fabricacion')->nullable();
            $table->string('placa', 20)->nullable();
            $table->string('partida_registral', 50)->nullable();
            $table->string('tipo_inmobiliaria', 50)->nullable();
            $table->string('direccion_inmobiliaria', 50)->nullable();
            $table->double('monto_ahorrado_liquido')->nullable();

            $table->index(["prestamo_id"], 'fk_garantias_prestamos1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('prestamo_id', 'fk_garantias_prestamos1_idx')
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
