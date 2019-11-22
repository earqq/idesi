<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvalsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'avals';

    /**
     * Run the migrations.
     * @table avals
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
            $table->string('nombres', 50)->nullable();
            $table->string('apellidos', 50)->nullable();
            $table->date('nacimiento')->nullable();
            $table->string('estado_civil', 10)->nullable();
            $table->string('ocupacion', 40)->nullable();
            $table->string('telefono', 10)->nullable();
            $table->string('celular', 10)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->string('distrito', 30)->nullable();
            $table->string('centro_laboral', 50)->nullable();
            $table->string('direccion_laboral', 100)->nullable();
            $table->integer('prestamos_id')->unsigned();

            $table->softDeletes();

            $table->timestamps();
            $table->index(["prestamos_id"], 'fk_avals_prestamos1_idx');


            $table->foreign('prestamos_id', 'fk_avals_prestamos1_idx')
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
       Schema::dropIfExists($this->set_schema_table);
     }
}
