<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeclaracionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'declaracions';

    /**
     * Run the migrations.
     * @table declaracions
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('uif', 2)->nullable()->default(null);
            $table->char('pep', 2)->nullable()->default(null);
            $table->date('fecha')->nullable()->default(null);
            $table->string('estado', 10)->nullable()->default(null);
            $table->text('observaciones')->nullable()->default(null);
            $table->unsignedInteger('naturals_id');

            $table->index(["naturals_id"], 'fk_declaracions_naturals1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('naturals_id', 'fk_declaracions_naturals1_idx')
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
