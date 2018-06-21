<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductosOfinec extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ReferenciaProducto')->unique();
            $table->string('NombreProducto');
            $table->double('Peso', 8, 2);
            $table->double('Precio', 8, 2);
            $table->string('FotoProducto');
            $table->integer('Cantidad');
            $table->enum('Categoria', ['granos', ',líquidos', 'verduras']);
            $table->enum('Estado', ['activo', ',inactivo']);
            $table->unsignedInteger('Usuario_id');
            $table->foreign('Usuario_id')->references('id')->on('users');;
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
        Schema::drop('productos');
    }
}
