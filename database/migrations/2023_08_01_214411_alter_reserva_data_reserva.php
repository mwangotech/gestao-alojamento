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
            $table->dateTime('dataInicio')->nullable()->after('totalCrianca');
            $table->dateTime('dataFim')->nullable()->after('dataInicio');
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
