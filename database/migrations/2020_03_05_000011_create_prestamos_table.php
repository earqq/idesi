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
    public $tableName = 'prestamos';

    /**
     * Run the migrations.
     * @table prestamos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->decimal('monto_cliente', 11, 2)->nullable()->default(null);
            $table->integer('cuotas_cliente')->nullable()->default(null);
            $table->double('disponibilidad_pago')->nullable()->default(null);
            $table->string('forma', 40)->nullable()->default(null);
            $table->string('producto_analista', 40)->nullable()->default(null);
            $table->decimal('importe_analista', 11, 2)->nullable()->default(null);
            $table->decimal('meses_analista', 11, 2)->nullable()->default(null);
            $table->decimal('aporte_analista', 11, 2)->nullable()->default(null);
            $table->double('cuota_sistema')->nullable()->default(null);
            $table->integer('cuotas_analista')->nullable()->default(null);
            $table->text('comentarios')->nullable()->default(null);
            $table->string('producto_final', 45)->nullable()->default(null);
            $table->decimal('aporte_final', 11, 2)->nullable()->default(null);
            $table->decimal('importe_final', 11, 2)->nullable()->default(null);
            $table->integer('cuotas_final')->nullable()->default(null);
            $table->boolean('cuantitativa')->nullable()->default('0');
            $table->boolean('cualitativa')->nullable()->default('0');
            $table->integer('estado')->nullable()->default('1');
            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('user_id');
            $table->double('probabilidad_infocorp')->nullable()->default(null);
            $table->string('latitud', 50)->nullable();
            $table->string('longitud', 50)->nullable();

            $table->index(["cliente_id"], 'fk_prestamos_clientes1_idx');

            $table->index(["user_id"], 'fk_prestamos_users1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('cliente_id', 'fk_prestamos_clientes1_idx')
                ->references('id')->on('clientes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_id', 'fk_prestamos_users1_idx')
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
       Schema::dropIfExists($this->tableName);
     }
}
