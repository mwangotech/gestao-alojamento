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
        Schema::create('tkt_estado', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 155);
            $table->string('cor', 20);
            $table->boolean('novo')->default(1);
            $table->boolean('aberto')->default(1);
            $table->boolean('fechado')->default(1);
            $table->boolean('sucesso')->default(1);
            $table->integer('ordem')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tkt_estado');
    }
};
