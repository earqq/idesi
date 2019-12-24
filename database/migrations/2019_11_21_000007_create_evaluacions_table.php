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
    public $set_schema_table = 'evaluacions';

    /**
     * Run the migrations.
     * @table evaluacions
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
           
            $table->string('detalle', 100)->nullable();
            $table->string('estado', 15)->nullable();
            $table->integer('prestamos_id')->unsigned();
            $table->integer('users_id')->unsigned();

            $table->softDeletes();

            $table->timestamps();
            
            $table->index(["users_id"], 'fk_evaluacions_users1_idx');

            $table->index(["prestamos_id"], 'fk_evaluacions_prestamos1_idx');


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
       Schema::dropIfExists($this->set_schema_table);
     }
}
