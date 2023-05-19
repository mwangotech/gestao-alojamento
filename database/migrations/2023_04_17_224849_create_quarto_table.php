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
        Schema::create('quarto', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 155);
            $table->text('descricao')->nullable();
            $table->integer('numero');
            $table->unsignedBigInteger('idFotoPrincipal')->nullable();
            $table->unsignedBigInteger('idEstadoQuarto');
            $table->integer('limit_adulto');
            $table->integer('limit_crianca');
            $table->decimal('preco', 12,2)->default(0);
            $table->timestamps();

            //$table->foreign('idFotoPrincipal')->references('id')->on('foto_quarto');
            $table->foreign('idEstadoQuarto')->references('id')->on('estado_quarto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quarto');
    }
};
