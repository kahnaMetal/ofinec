<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComprasOfinec extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('Usuario_id');
          $table->unsignedInteger('Producto_id');
          $table->double('Valor', 8, 2);
          $table->integer('Cantidad');
          $table->date('Fecha');
          $table->foreign('Usuario_id')->references('id')->on('users');
          $table->foreign('Producto_id')->references('id')->on('productos');;
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
        Schema::drop('compras');
    }
}
