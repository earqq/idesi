<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'prestamos';

    /**
     * Run the migrations.
     * @table prestamos
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->double('monto_inicial')->nullable()->default(null);
            $table->integer('plazo_inicial')->nullable()->default(null);
            $table->string('disponibilidad_pago_inicial', 30)->nullable()->default(null);
            $table->string('destino_inicial', 30)->nullable()->default(null);
            $table->string('forma_inicial', 30)->nullable()->default(null);
            $table->decimal('meses', 11, 2)->nullable()->default(null);
            $table->string('producto', 40)->nullable()->default(null);
            $table->string('forma', 40)->nullable()->default(null);
            $table->decimal('importe', 11, 2)->nullable()->default(null);
            $table->decimal('aporte', 11, 2)->nullable()->default(null);
            $table->integer('plazo')->nullable()->default(null);
            $table->integer('cuotas')->nullable()->default(null);
            $table->decimal('tasa', 11, 2)->nullable()->default(null);
            $table->text('comentarios')->nullable()->default(null);
            $table->string('producto_final', 45)->nullable()->default(null);
            $table->string('forma_final', 45)->nullable()->default(null);
            $table->decimal('aporte_final', 11, 2)->nullable()->default(null);
            $table->decimal('importe_final', 11, 2)->nullable()->default(null);
            $table->integer('plazo_final')->nullable()->default(null);
            $table->integer('cuota_final')->nullable()->default(null);
            $table->decimal('tasa_final', 11, 2)->nullable()->default(null);
            $table->integer('cuantitativa')->nullable()->default(null);
            $table->integer('cualitativa')->nullable()->default(null);
            $table->string('estado', 15)->nullable()->default(null);
            $table->unsignedInteger('clientes_id');
            $table->unsignedInteger('users_id');
            $table->double('probabilidad_infocorp')->nullable();

            $table->index(["clientes_id"], 'fk_prestamos_clientes1_idx');

            $table->index(["users_id"], 'fk_prestamos_users1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('clientes_id', 'fk_prestamos_clientes1_idx')
                ->references('id')->on('clientes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('users_id', 'fk_prestamos_users1_idx')
                ->references('id')->on('users')
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