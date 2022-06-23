<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('1');
            $table->string('name');
            $table->string('app');
            $table->string('apm');
            $table->string('telefono');
            //Direccion
            $table->string('colonia');
            $table->string('calle');
            $table->string('num_calle');
            $table->string('cod_postal');
            $table->string('estado');
            $table->string('municipio');

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            //Rol y Area
            $table->unsignedBigInteger('id_area')->unsigned();
            $table->unsignedBigInteger('id_rol')->unsigned(); //rolo del usuario

            $table->foreign('id_area')
                ->references('id')
                ->on('areas')
                ->onDelete('cascade');
            
            $table->foreign('id_rol')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
