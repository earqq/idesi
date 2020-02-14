<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHijosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'hijos';

    /**
     * Run the migrations.
     * @table hijos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombres', 100)->nullable()->default(null);
            $table->integer('documento')->nullable()->default(null);
            $table->date('fecha_nacimiento')->nullable()->default(null);
            $table->boolean('socio')->nullable()->default(null);
            $table->unsignedInteger('persona_id');

            $table->index(["persona_id"], 'fk_hijos_personas1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('persona_id', 'fk_hijos_personas1_idx')
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
