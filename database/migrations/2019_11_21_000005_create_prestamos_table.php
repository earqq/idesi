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
            $table->double('monto_inicial')->nullable();
            $table->integer('plazo_inicial')->nullable();
            $table->string('disponibilidad_pago_inicial', 30)->nullable();
            $table->string('destino_inicial', 30)->nullable();
            $table->string('forma_inicial', 30)->nullable();
            $table->string('producto', 40)->nullable();
            $table->string('forma', 40)->nullable();
            $table->decimal('importe', 11, 2)->nullable();
            $table->decimal('aporte', 11, 2)->nullable();
            $table->integer('plazo')->nullable();
            $table->integer('cuotas')->nullable();
            $table->decimal('tasa', 11, 2)->nullable();
            $table->text('comentarios')->nullable();
            $table->string('producto_final', 45)->nullable();
            $table->string('forma_final', 45)->nullable();
            $table->decimal('aporte_final', 11, 2)->nullable();
            $table->decimal('importe_final', 11, 2)->nullable();
            $table->integer('plazo_final')->nullable();
            $table->integer('cuota_final')->nullable();
            $table->decimal('tasa_final', 11, 2)->nullable();
            $table->string('estado', 10)->nullable();
            $table->integer('clientes_id')->unsigned();
            $table->integer('users_id')->unsigned();
            
            $table->softDeletes();

            $table->timestamps();
            $table->index(["clientes_id"], 'fk_prestamos_clientes1_idx');

            $table->index(["users_id"], 'fk_prestamos_users1_idx');


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
