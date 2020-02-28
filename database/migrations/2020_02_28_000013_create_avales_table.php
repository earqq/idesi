<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvalesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'avales';

    /**
     * Run the migrations.
     * @table avales
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('documento')->nullable()->default(null);
            $table->string('tipo_persona', 2)->nullable()->default(null);
            $table->string('nombres', 50)->nullable()->default(null);
            $table->string('apellidos', 50)->nullable()->default(null);
            $table->date('fecha_nacimiento')->nullable()->default(null);
            $table->string('estado_civil', 30)->nullable()->default(null);
            $table->string('ocupacion', 40)->nullable()->default(null);
            $table->string('telefono', 10)->nullable()->default(null);
            $table->string('celular', 15)->nullable()->default(null);
            $table->string('direccion', 100)->nullable()->default(null);
            $table->string('distrito', 30)->nullable()->default(null);
            $table->string('centro_laboral', 50)->nullable()->default(null);
            $table->string('direccion_centro_laboral', 100)->nullable()->default(null);
            $table->boolean('socio')->nullable()->default(null);
            $table->string('codigo_socio', 10)->nullable()->default(null);
            $table->decimal('aporte_socio', 11, 2)->nullable()->default(null);
            $table->unsignedInteger('prestamo_id');
            $table->string('empresa_ruc', 11)->nullable();
            $table->string('empresa_razon_social', 200)->nullable();
            $table->string('empresa_direccion', 200)->nullable();

            $table->index(["prestamo_id"], 'fk_avals_prestamos1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('prestamo_id', 'fk_avals_prestamos1_idx')
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
