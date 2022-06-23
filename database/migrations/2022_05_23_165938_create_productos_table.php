<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo_producto');
            $table->string('descripcion');
            $table->string('imagen')->nullable();
            $table->integer('stock');
            $table->integer('activo');

            $table->unsignedBigInteger('id_categoria')->unsigned();
            $table->unsignedBigInteger('id_unidad')->unsigned();

            $table->foreign('id_categoria')
                ->references('id')
                ->on('categorias')
                ->onDelete('cascade');
            
            $table->foreign('id_unidad')
                ->references('id')
                ->on('unidades')
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
        Schema::dropIfExists('productos');
    }
}
