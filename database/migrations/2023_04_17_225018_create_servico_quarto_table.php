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
        Schema::create('servico_quarto', function (Blueprint $table) {
            $table->primary(['idServico', 'idQuarto'],'servico_quarto_id');
            $table->unsignedBigInteger('idServico');
            $table->unsignedBigInteger('idQuarto');
            
            $table->foreign('idServico')->references('id')->on('servico');
            $table->foreign('idQuarto')->references('id')->on('quarto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servico_quarto');
    }
};
