<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function(Blueprint $table){
            $table->id();
            $table->string('cnpj', 14);
            $table->string('razao_social', 100);
            $table->string('endereco', 100);
            $table->string('cidade', 100);
            $table->string('uf', 2);
            $table->string('cep', 8);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExist('clientes');
    }
}
