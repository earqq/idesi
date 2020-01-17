<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistritosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'distritos';

    /**
     * Run the migrations.
     * @table distritos
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('provincia_id');
            $table->string('descripcion');
            $table->tinyInteger('activo')->default('1');

            $table->index(["provincia_id"], 'distritos_provincia_id_foreign');

            $table->unique(["id"], 'distritos_id_unique');


            $table->foreign('provincia_id', 'distritos_provincia_id_foreign')
                ->references('id')->on('provincias')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
