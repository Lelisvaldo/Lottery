<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesCepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes__ceps', function (Blueprint $table) {
            $table->integer('cliente_id')->unsigned();
            $table->integer('cep_id')->unsigned();
            $table->primary(['cliente_id', 'cep_id']);
        });

        Schema::table('clientes__ceps', function (Blueprint $table) {
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });

        Schema::table('clientes__ceps', function (Blueprint $table) {
            $table->foreign('cep_id')->references('id')->on('ceps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes__ceps');
    }
}
