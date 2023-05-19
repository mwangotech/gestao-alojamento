<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tkt_ticket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idAssunto');
            $table->unsignedBigInteger('idCliente');
            $table->unsignedBigInteger('idUtilizador');
            $table->unsignedBigInteger('idUtilizadorAtribuido');
            $table->unsignedBigInteger('idEstado');
            $table->text('notas');
            $table->timestamps();

            $table->foreign('idAssunto')->references('id')->on('tkt_assunto');
            $table->foreign('idCliente')->references('id')->on('cliente');
            $table->foreign('idUtilizador')->references('id')->on('users');
            $table->foreign('idUtilizadorAtribuido')->references('id')->on('users');
            $table->foreign('idEstado')->references('id')->on('tkt_estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tkt_ticket');
    }
};
