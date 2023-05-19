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
        Schema::create('perfil_menu', function (Blueprint $table) {
            $table->primary(['idPerfil', 'idMenu'],'perfil_menu_id');
            $table->unsignedBigInteger('idPerfil');
            $table->unsignedBigInteger('idMenu');
            
            $table->foreign('idPerfil')->references('id')->on('perfil');
            $table->foreign('idMenu')->references('id')->on('menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil_menu');
    }
};
