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
        Schema::create('ficheiro_documento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idDocumento');
            $table->string('mascara');
            $table->string('nomeFicheiro');
            $table->text('notas')->nullable();
            $table->unsignedBigInteger('idUtilizador');
            $table->timestamps();

            $table->foreign('idDocumento')->references('id')->on('documento');
            $table->foreign('idUtilizador')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficheiro_documento');
    }
};
