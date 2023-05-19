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
        Schema::create('foto_quarto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idQuarto');
            $table->string('nomeFicheiro');
            $table->string('mascara');

            $table->foreign('idQuarto')->references('id')->on('quarto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_quarto');
    }
};
