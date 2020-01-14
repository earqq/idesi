<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObligacionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'obligacions';

    /**
     * Run the migrations.
     * @table obligacions
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->double('inscripcion')->nullable()->default(null);
            $table->double('aporte')->nullable()->default(null);
            $table->double('fondo')->nullable()->default(null);
            $table->double('fondo_opcional')->nullable()->default(null);
            $table->unsignedInteger('naturals_id');

            $table->index(["naturals_id"], 'fk_obligacions_naturals1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('naturals_id', 'fk_obligacions_naturals1_idx')
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
