<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'detalles';

    /**
     * Run the migrations.
     * @table detalles
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombres', 45)->nullable()->default(null);
            $table->integer('documento')->nullable()->default(null);
            $table->string('parentesco', 30)->nullable()->default(null);
            $table->char('socio', 2)->nullable()->default(null);
            $table->unsignedInteger('familiars_id');

            $table->index(["familiars_id"], 'fk_detalles_familiars1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('familiars_id', 'fk_detalles_familiars1_idx')
                ->references('id')->on('familiars')
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
