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
        Schema::create('voucher_prestador', function (Blueprint $table) {
            $table->primary(['idPrestador', 'idVoucher'],'voucher_prestador_id');
            $table->unsignedBigInteger('idPrestador');
            $table->unsignedBigInteger('idVoucher');
            
            $table->foreign('idPrestador')->references('id')->on('prestador');
            $table->foreign('idVoucher')->references('id')->on('voucher');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_prestador');
    }
};
