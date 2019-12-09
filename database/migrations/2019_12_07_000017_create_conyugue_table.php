<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConyugueTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'conyugue';

    /**
     * Run the migrations.
     * @table conyugue
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('documento')->nullable();
            $table->string('nombres', 45)->nullable();
            $table->string('apellidos', 45)->nullable();
            $table->date('nacimiento')->nullable();
            $table->string('estado_civil', 30)->nullable();
            $table->string('ocupacion', 50)->nullable();
            $table->string('telefono', 10)->nullable();
            $table->string('celular', 10)->nullable();
            $table->string('centro_laboral', 10)->nullable();
            $table->string('direccion', 50)->nullable();
            $table->unsignedInteger('naturals_id');

            $table->softDeletes();

            $table->timestamps();
            
            $table->index(["naturals_id"], 'fk_conyugue_naturals1_idx');


            $table->foreign('naturals_id', 'fk_conyugue_naturals1_idx')
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
