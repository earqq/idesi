<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGarantiasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'garantias';

    /**
     * Run the migrations.
     * @table garantias
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('bien_garantia', 50)->nullable()->default(null);
            $table->string('inscripcion', 50)->nullable()->default(null);
            $table->string('declaracion_jurada', 100)->nullable()->default(null);
            $table->string('tipo', 10)->nullable()->default(null);
            $table->unsignedInteger('prestamos_id');

            $table->index(["prestamos_id"], 'fk_garantias_prestamos1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('prestamos_id', 'fk_garantias_prestamos1_idx')
                ->references('id')->on('prestamos')
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
