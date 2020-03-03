<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenciasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'referencias';

    /**
     * Run the migrations.
     * @table referencias
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tipo_relacion', 100)->nullable();
            $table->text('nombres')->nullable();
            $table->string('telefonos', 100)->nullable();
            $table->unsignedInteger('cualitativa_id');

            $table->index(["cualitativa_id"], 'fk_referencias_cualitativas1_idx');


            $table->foreign('cualitativa_id', 'fk_referencias_cualitativas1_idx')
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
