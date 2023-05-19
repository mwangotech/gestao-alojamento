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
        Schema::create('pagamento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCliente');
            $table->unsignedBigInteger('idReserva');
            $table->unsignedBigInteger('idMetodoPagamento');
            $table->unsignedBigInteger('idEstadoPagamento');
            $table->decimal('montante', 12,2);
            $table->dateTime('dataPagamento');
            $table->timestamps();

            $table->foreign('idCliente')->references('id')->on('cliente');
            $table->foreign('idReserva')->references('id')->on('reserva');
            $table->foreign('idMetodoPagamento')->references('id')->on('metodo_pagamento');
            $table->foreign('idEstadoPagamento')->references('id')->on('estado_pagamento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamento');
    }
};
