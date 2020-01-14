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
    public $tableName = 'conyugue';

    /**
     * Run the migrations.
     * @table conyugue
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('documento')->nullable()->default(null);
            $table->string('nombres', 100)->nullable()->default(null);
            $table->date('nacimiento')->nullable()->default(null);
            $table->string('estado_civil', 30)->nullable()->default(null);
            $table->string('ocupacion', 50)->nullable()->default(null);
            $table->string('telefono', 10)->nullable()->default(null);
            $table->string('celular', 15)->nullable()->default(null);
            $table->string('centro_laboral', 10)->nullable()->default(null);
            $table->string('direccion', 50)->nullable()->default(null);
            $table->string('socio', 5)->nullable()->default(null);
            $table->string('codigo_socio', 10)->nullable()->default(null);
            $table->decimal('aporte_socio', 11, 2)->nullable()->default(null);
            $table->unsignedInteger('naturals_id');

            $table->index(["naturals_id"], 'fk_conyugue_naturals1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


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
       Schema::dropIfExists($this->tableName);
     }
}
