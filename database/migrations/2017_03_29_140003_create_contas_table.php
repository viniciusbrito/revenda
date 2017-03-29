<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas', function (Blueprint $table) {
            $table->increments('idConta');
            $table->string('dominio', 255);
            $table->string('usuario', 255);
            $table->string('senha', 255);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('pacote_id');
            $table->boolean('nova_conta')->default(true);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('pacote_id')
                ->references('idPacote')
                ->on('pacotes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas');
    }
}
