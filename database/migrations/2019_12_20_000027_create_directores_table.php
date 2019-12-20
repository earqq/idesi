<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectoresTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'directores';

    /**
     * Run the migrations.
     * @table directores
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombres', 60)->nullable();
            $table->integer('documento')->nullable();
            $table->unsignedInteger('juridicos_id');
            $table->softDeletes();

            $table->timestamps();

            $table->index(["juridicos_id"], 'fk_directores_juridicos1_idx');


            $table->foreign('juridicos_id', 'fk_directores_juridicos1_idx')
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
