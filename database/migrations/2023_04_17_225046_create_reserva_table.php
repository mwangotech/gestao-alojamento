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
        Schema::create('reserva', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCliente');
            $table->unsignedBigInteger('idQuarto');
            $table->unsignedBigInteger('idEstadoReserva');
            $table->integer('totalAdulto')->default(0);
            $table->integer('totalCrianca')->default(0);
            $table->dateTime('checkin')->nullable();
            $table->dateTime('checkout')->nullable();
            $table->timestamps();

            $table->foreign('idCliente')->references('id')->on('cliente');
            $table->foreign('idQuarto')->references('id')->on('quarto');
            $table->foreign('idEstadoReserva')->references('id')->on('estado_reserva');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva');
    }
};
