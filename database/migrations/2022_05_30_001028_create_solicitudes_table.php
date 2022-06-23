<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->integer('id_solicitud')->nullable()->unsigned();
            $table->string('codigo_solicitud', 12)->primary();
            $table->integer('num_productos');
            
            $table->unsignedBigInteger('id_usuario')->unsigned();
            $table->unsignedBigInteger('id_status')->unsigned();

            $table->foreign('id_usuario')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->foreign('id_status')
                ->references('id')
                ->on('status')
                ->onDelete('cascade');

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
        Schema::dropIfExists('solicitudes');
    }
}
