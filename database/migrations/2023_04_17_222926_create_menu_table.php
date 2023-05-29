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
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idMenu')->nullable();
            $table->string('nome', 50);
            $table->string('icone', 20)->nullable();
            $table->string('link', 250)->nullable();
            $table->string('route', 150)->nullable();
            $table->string('codigo', 10);
            $table->enum('tipo', ['item', 'collapse']);
            $table->integer('ordem')->default(0);
            $table->boolean('visivel')->default(1);
            $table->boolean('estado')->default(1);
            $table->timestamps();

            $table->foreign('idMenu')->references('id')->on('menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
