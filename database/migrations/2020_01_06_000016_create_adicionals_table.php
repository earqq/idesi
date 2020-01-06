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
    public $tableName = 'adicionals';

    /**
     * Run the migrations.
     * @table adicionals
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('representante', 45)->nullable()->default(null);
            $table->string('documento', 45)->nullable()->default(null);
            $table->string('numero', 45)->nullable()->default(null);
            $table->string('relacion', 45)->nullable()->default(null);
            $table->unsignedInteger('naturals_id');

            $table->index(["naturals_id"], 'fk_adicionals_naturals1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


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
       Schema::dropIfExists($this->tableName);
     }
}
