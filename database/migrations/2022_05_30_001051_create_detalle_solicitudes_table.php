<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            
            $table->string('codigo_solicitud');
            $table->unsignedBigInteger('id_producto')->unsigned();

            $table->foreign('codigo_solicitud')
                ->references('codigo_solicitud')
                ->on('solicitudes')
                ->onDelete('cascade');

            $table->foreign('id_producto')
                ->references('id')
                ->on('productos')
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
        Schema::dropIfExists('detalle_solicitudes');
    }
}
