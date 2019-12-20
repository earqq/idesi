<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdicionalsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'adicionals';

    /**
     * Run the migrations.
     * @table adicionals
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('representante', 45)->nullable();
            $table->string('documento', 45)->nullable();
            $table->string('numero', 45)->nullable();
            $table->string('relacion', 45)->nullable();
            $table->unsignedInteger('naturals_id');
            $table->softDeletes();

            $table->timestamps();

            $table->index(["naturals_id"], 'fk_adicionals_naturals1_idx');


            $table->foreign('naturals_id', 'fk_adicionals_naturals1_idx')
                ->references('id')->on('naturals')
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
