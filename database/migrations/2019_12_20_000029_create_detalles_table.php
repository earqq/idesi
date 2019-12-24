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
    public $set_schema_table = 'detalles';

    /**
     * Run the migrations.
     * @table detalles
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombres', 45)->nullable();
            $table->integer('documento')->nullable();
            $table->string('parentesco', 30)->nullable();
            $table->char('socio', 2)->nullable();
            $table->unsignedInteger('familiars_id');
            $table->softDeletes();

            $table->timestamps();

            $table->index(["familiars_id"], 'fk_detalles_familiars1_idx');


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
       Schema::dropIfExists($this->set_schema_table);
     }
}
