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
        Schema::create('perfil_utilizador', function (Blueprint $table) {
            $table->primary(['idPerfil', 'idUtilizador'],'perfil_utilizador_id');
            $table->unsignedBigInteger('idPerfil');
            $table->unsignedBigInteger('idUtilizador');
            
            $table->foreign('idPerfil')->references('id')->on('perfil');
            $table->foreign('idUtilizador')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil_utilizador');
    }
};
