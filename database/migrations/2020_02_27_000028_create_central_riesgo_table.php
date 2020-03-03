<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentralRiesgoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'central_riesgo';

    /**
     * Run the migrations.
     * @table central_riesgo
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('cualitativa_id');
            $table->text('entidad')->nullable();
            $table->boolean('capital_trabajo')->nullable()->default('0');
            $table->boolean('activo_fijo')->nullable()->default('0');
            $table->boolean('consumo')->nullable()->default('0');
            $table->boolean('vehicular')->nullable()->default('0');
            $table->boolean('hipotecario')->nullable()->default('0');
            $table->boolean('terceros')->nullable();

            $table->index(["cualitativa_id"], 'fk_central_riesgo_cualitativa1_idx');


            $table->foreign('cualitativa_id', 'fk_central_riesgo_cualitativa1_idx')
                ->references('id')->on('cualitativas')
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
