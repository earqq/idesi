<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccionistasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'accionistas';

    /**
     * Run the migrations.
     * @table accionistas
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
            $table->unsignedInteger('empresa_id');

            $table->index(["empresa_id"], 'fk_accionistas_juridicos1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('empresa_id', 'fk_accionistas_juridicos1_idx')
                ->references('id')->on('empresas')
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
