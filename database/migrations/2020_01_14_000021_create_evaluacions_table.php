<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'evaluacions';

    /**
     * Run the migrations.
     * @table evaluacions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('detalle', 100)->nullable()->default(null);
            $table->string('estado', 15)->nullable()->default(null);
            $table->unsignedInteger('prestamos_id');
            $table->unsignedInteger('users_id');

            $table->index(["users_id"], 'fk_evaluacions_users1_idx');

            $table->index(["prestamos_id"], 'fk_evaluacions_prestamos1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('prestamos_id', 'fk_evaluacions_prestamos1_idx')
                ->references('id')->on('prestamos')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('users_id', 'fk_evaluacions_users1_idx')
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
