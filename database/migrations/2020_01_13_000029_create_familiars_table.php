<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamiliarsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'familiars';

    /**
     * Run the migrations.
     * @table familiars
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('hijos', 2)->nullable();
            $table->integer('numero')->nullable()->default('0');
            $table->char('conyugue', 2)->nullable()->default(null);
            $table->string('ocupacion', 15)->nullable()->default(null);
            $table->unsignedInteger('naturals_id');

            $table->index(["naturals_id"], 'fk_familiars_naturals1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('naturals_id', 'fk_familiars_naturals1_idx')
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
