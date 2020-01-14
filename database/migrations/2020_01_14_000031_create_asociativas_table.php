<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsociativasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'asociativas';

    /**
     * Run the migrations.
     * @table asociativas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->double('inscripcion')->nullable()->default(null);
            $table->double('aporte')->nullable()->default(null);
            $table->unsignedInteger('juridicos_id');

            $table->index(["juridicos_id"], 'fk_asociativas_juridicos1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('juridicos_id', 'fk_asociativas_juridicos1_idx')
                ->references('id')->on('juridicos')
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
