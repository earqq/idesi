<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('tipo_documento', 20)->nullable()->default(null);
            $table->string('num_documento', 20);
            $table->string('direccion', 70)->nullable()->default(null);
            $table->string('telefono', 20)->nullable()->default(null);
            $table->string('email');
            $table->string('usuario');
            $table->string('password');
            $table->tinyInteger('condicion')->default('1');
            $table->timestamp('email_verified_at')->nullable()->default(null);
            $table->rememberToken();
            $table->unsignedInteger('idrol');

            $table->index(["idrol"], 'users_idrol_foreign');

            $table->unique(["usuario"], 'users_usuario_unique');

            $table->unique(["num_documento"], 'users_num_documento_unique');

            $table->unique(["email"], 'users_email_unique');
            $table->nullableTimestamps();


            $table->foreign('idrol', 'users_idrol_foreign')
                ->references('id')->on('roles')
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
