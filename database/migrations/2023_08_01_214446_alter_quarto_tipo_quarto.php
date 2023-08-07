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
        Schema::table('quarto', function (Blueprint $table) {
            $table->unsignedBigInteger('idTipoQuarto')->after('idFotoPrincipal');
            $table->foreign('idTipoQuarto')->references('id')->on('tipo_quarto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quarto', function (Blueprint $table) {
            //
        });
    }
};
