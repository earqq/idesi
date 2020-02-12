<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'evaluaciones';

    /**
     * Run the migrations.
     * @table evaluaciones
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('detalle', 100)->nullable()->default(null);
            $table->integer('estado')->nullable()->default(null);
            $table->unsignedInteger('prestamo_id');
            $table->unsignedInteger('user_id');

            $table->index(["user_id"], 'fk_evaluacions_users1_idx');

            $table->index(["prestamo_id"], 'fk_evaluacions_prestamos1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('prestamo_id', 'fk_evaluacions_prestamos1_idx')
                ->references('id')->on('prestamos')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_id', 'fk_evaluacions_users1_idx')
                ->references('id')->on('users')
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
