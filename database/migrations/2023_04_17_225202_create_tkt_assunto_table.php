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
        Schema::create('tkt_assunto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idAssuntoPrincipal');
            $table->string('nome', 155);
            $table->integer('ordem')->default(0);
            $table->boolean('estado')->default(1);

            $table->foreign('idAssuntoPrincipal')->references('id')->on('tkt_assunto_principal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tkt_assunto');
    }
};
