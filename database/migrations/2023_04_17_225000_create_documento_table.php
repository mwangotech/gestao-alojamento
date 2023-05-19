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
        Schema::create('documento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCliente');
            $table->unsignedBigInteger('idTipoDocumento');
            $table->unsignedBigInteger('paisEmissao');
            $table->string('valor', 155)->nullable();
            $table->string('entidadeEmissora', 155)->nullable();
            $table->date('dataEmissao')->nullable();
            $table->date('dataExpiracao')->nullable();
            $table->timestamps();

            $table->foreign('idCliente')->references('id')->on('cliente');
            $table->foreign('idTipoDocumento')->references('id')->on('tipo_documento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documento');
    }
};
