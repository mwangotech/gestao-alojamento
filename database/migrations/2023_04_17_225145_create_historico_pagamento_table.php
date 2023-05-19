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
        Schema::create('historico_pagamento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPagamento');
            $table->unsignedBigInteger('idUtilizador');
            $table->unsignedBigInteger('idEstadoPagamento');
            $table->text('notas')->nullable();
            $table->string('anexo', 255)->nullable();
            $table->timestamps();

            $table->foreign('idPagamento')->references('id')->on('pagamento');
            $table->foreign('idUtilizador')->references('id')->on('users');
            $table->foreign('idEstadoPagamento')->references('id')->on('estado_pagamento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_pagamento');
    }
};
