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
    public $set_schema_table = 'asociativas';

    /**
     * Run the migrations.
     * @table asociativas
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->double('inscripcion')->nullable();
            $table->double('aporte')->nullable();
            $table->unsignedInteger('juridicos_id');
            $table->softDeletes();

            $table->timestamps();
            
            $table->index(["juridicos_id"], 'fk_asociativas_juridicos1_idx');


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
       Schema::dropIfExists($this->set_schema_table);
     }
}
