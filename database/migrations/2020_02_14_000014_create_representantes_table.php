<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepresentantesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'representantes';

    /**
     * Run the migrations.
     * @table representantes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tipo_documento', 9)->nullable();
            $table->string('documento', 9)->nullable();
            $table->string('relacion', 6)->nullable();
            $table->unsignedInteger('persona_id');
            $table->string('nombres', 100)->nullable();

            $table->index(["persona_id"], 'fk_adicionals_naturals1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('persona_id', 'fk_adicionals_naturals1_idx')
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
