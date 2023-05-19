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
        Schema::create('voucher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idReserva');
            $table->integer('numero');
            $table->decimal('montante',12,2);
            $table->string('uniqId', 45);
            $table->date('dataReserva');
            $table->dateTime('dataUso')->nullable();
            $table->dateTime('dataValidacao')->nullable();
            $table->timestamps();

            $table->foreign('idReserva')->references('id')->on('reserva');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher');
    }
};
