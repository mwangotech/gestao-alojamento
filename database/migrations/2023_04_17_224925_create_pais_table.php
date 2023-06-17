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
        Schema::create('pais', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('nacionalidade')->nullable();
            $table->string('prefixTelefone', 10)->nullable();
            $table->string('regexTelefone', 255)->nullable();
            $table->string('codigoIso2', 2);
            $table->string('codigoIso3', 3);
            $table->text('formatoEndereco')->nullable();
            $table->boolean('codigoPostalObrigatorio')->default(0);
            $table->integer('ordem')->default(0);
            $table->boolean('estado')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pais');
    }
};
