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
        Schema::create('comodidade_quarto', function (Blueprint $table) {
            $table->primary(['idComodidade', 'idQuarto'],'comodidade_quarto_id');
            $table->unsignedBigInteger('idComodidade');
            $table->unsignedBigInteger('idQuarto');
            
            $table->foreign('idComodidade')->references('id')->on('comodidade');
            $table->foreign('idQuarto')->references('id')->on('quarto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comodidade_quarto');
    }
};
