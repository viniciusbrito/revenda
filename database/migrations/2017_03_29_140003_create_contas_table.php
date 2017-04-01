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
        Schema::create('conta_status', function (Blueprint $table) {
            $table->increments('idStatus');
            $table->string('status');

        });

        Schema::create('contas', function (Blueprint $table) {
            $table->increments('idConta');
            $table->string('dominio', 255);
            $table->string('usuario', 50);
            $table->string('senha', 25);
            $table->unsignedInteger('status_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('pacote_id');
            $table->boolean('nova_conta')->default(true);
            $table->timestamps();

            $table->foreign('status_id')
                ->references('idStatus')
                ->on('conta_status');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('pacote_id')
                ->references('idPacote')
                ->on('pacotes')->onDelete('set null');

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
        Schema::dropIfExists('conta_status');
    }
}
