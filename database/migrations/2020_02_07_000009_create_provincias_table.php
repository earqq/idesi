<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvinciasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'provincias';

    /**
     * Run the migrations.
     * @table provincias
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('departamento_id');
            $table->string('descripcion', 191);
            $table->tinyInteger('activo')->default('1');

            $table->index(["departamento_id"], 'provincias_departamento_id_foreign');

            $table->unique(["id"], 'provincias_id_unique');


            $table->foreign('departamento_id', 'provincias_departamento_id_foreign')
                ->references('id')->on('departamentos')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
