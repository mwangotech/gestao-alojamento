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
        Schema::create('historico_reserva', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idReserva');
            $table->unsignedBigInteger('idUtilizador');
            $table->unsignedBigInteger('idEstadoReserva');
            $table->text('notas')->nullable();
            $table->timestamps();

            $table->foreign('idReserva')->references('id')->on('reserva');
            $table->foreign('idUtilizador')->references('id')->on('users');
            $table->foreign('idEstadoReserva')->references('id')->on('estado_reserva');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_reserva');
    }
};
