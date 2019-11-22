<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVistasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'vistas';

    /**
     * Run the migrations.
     * @table vistas
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('imagen', 45)->nullable();
            $table->date('fecha')->nullable();
            $table->string('hora', 5)->nullable();
            $table->string('motivo', 50)->nullable();
            $table->string('latitud', 50)->nullable();
            $table->string('altitud', 50)->nullable();
            $table->char('estado', 1)->nullable();
            $table->integer('prestamos_id')->unsigned();

            $table->softDeletes();

            $table->timestamps();
            
            $table->index(["prestamos_id"], 'fk_vistas_prestamos1_idx');


            $table->foreign('prestamos_id', 'fk_vistas_prestamos1_idx')
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
