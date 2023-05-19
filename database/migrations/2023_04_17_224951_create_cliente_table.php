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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTipo');
            $table->string('nome', 155);
            $table->string('email', 150);
            $table->string('telefone', 20)->nullable();
            $table->unsignedBigInteger('idNacionalidade');
            $table->unsignedBigInteger('idProvincia')->nullable();
            $table->unsignedBigInteger('idGenero');
            $table->unsignedBigInteger('idEstadoCivil');
            $table->date('dataNascimento')->nullable();
            $table->string('profissao')->nullable();
            $table->timestamps();

            $table->foreign('idTipo')->references('id')->on('tipo_cliente');
            $table->foreign('idNacionalidade')->references('id')->on('pais');
            $table->foreign('idProvincia')->references('id')->on('perfil');
            $table->foreign('idGenero')->references('id')->on('genero');
            $table->foreign('idEstadoCivil')->references('id')->on('estado_civil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
