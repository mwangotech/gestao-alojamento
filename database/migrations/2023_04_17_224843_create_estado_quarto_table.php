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
        Schema::create('estado_quarto', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 155);
            $table->string('cor', 20)->nullable();
            $table->integer('ordem')->default(0);
            $table->boolean('estado')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_quarto');
    }
};
