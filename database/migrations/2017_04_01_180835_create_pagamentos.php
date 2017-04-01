<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->increments('idPagamento');
            $table->string('codigo');
            $table->string('referencia');
            $table->unsignedInteger('status' );
            $table->unsignedInteger('conta_id');
            $table->timestamps();

            $table->foreign('conta_id')
                ->references('idConta')
                ->on('contas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
}
