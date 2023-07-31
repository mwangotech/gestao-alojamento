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
        Schema::table('reserva', function (Blueprint $table) {
            $table->unsignedBigInteger('idUtilizador');
            $table->integer('qtdDias')->default(0);
            $table->decimal('preco', 12,2)->default(0);
            $table->decimal('valor', 12,2)->default(0);


            $table->foreign('idUtilizador')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reserva', function (Blueprint $table) {
            //
        });
    }
};
