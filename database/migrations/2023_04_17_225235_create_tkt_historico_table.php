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
        Schema::create('tkt_historico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTicket');
            $table->unsignedBigInteger('idEstado');
            $table->unsignedBigInteger('idUtilizador');
            $table->unsignedBigInteger('idUtilizadorAtribuido');
            $table->text('notas');
            $table->timestamps();

            $table->foreign('idTicket')->references('id')->on('tkt_ticket');
            $table->foreign('idEstado')->references('id')->on('tkt_estado');
            $table->foreign('idUtilizador')->references('id')->on('users');
            $table->foreign('idUtilizadorAtribuido')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tkt_historico');
    }
};
