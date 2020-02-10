<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConyugesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'conyuges';

    /**
     * Run the migrations.
     * @table conyuges
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('documento')->nullable();
            $table->string('nombres', 100)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('estado_civil', 30)->nullable();
            $table->string('ocupacion', 100)->nullable();
            $table->string('telefono', 10)->nullable();
            $table->string('celular', 15)->nullable();
            $table->string('centro_laboral', 200)->nullable();
            $table->string('direccion_centro_laboral')->nullable();
            $table->boolean('socio')->nullable();
            $table->string('codigo_socio', 10)->nullable();
            $table->decimal('aporte_socio', 11, 2)->nullable();
            $table->unsignedInteger('persona_id');
            $table->boolean('trabaja')->nullable()->default(null);

            $table->index(["persona_id"], 'fk_conyugue_naturals1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('persona_id', 'fk_conyugue_naturals1_idx')
                ->references('id')->on('personas')
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
