<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsociativaNaturalTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'asociativa_natural';

    /**
     * Run the migrations.
     * @table asociativa_natural
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->decimal('inscripcion', 11, 2)->nullable()->default('0.00');
            $table->decimal('aporte', 11, 2)->nullable()->default('0.00');
            $table->decimal('fondo', 11, 2)->nullable()->default('0.00');
            $table->decimal('fondo_opcional', 11, 2)->nullable()->default('0.00');
            $table->unsignedInteger('naturals_id');

            $table->index(["naturals_id"], 'fk_asociativa_natural_naturals1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('naturals_id', 'fk_asociativa_natural_naturals1_idx')
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
