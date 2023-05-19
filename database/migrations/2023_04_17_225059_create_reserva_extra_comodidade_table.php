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
        Schema::create('reserva_extra_comodidade', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idReserva');
            $table->unsignedBigInteger('idComodidade');
            $table->decimal('preco', 12,2)->default(0);
            $table->text('notas')->nullable();
            $table->timestamps();

            $table->foreign('idReserva')->references('id')->on('reserva');
            $table->foreign('idComodidade')->references('id')->on('comodidade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva_extra_comodidade');
    }
};
