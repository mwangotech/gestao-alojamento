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
        Schema::create('checkin_config', function (Blueprint $table) {
            $table->id();
            $table->integer('horaCheckin')->default(14);
            $table->integer('minuteCheckin')->default(0);
            $table->integer('horaCheckout')->default(12);
            $table->integer('minuteCheckout')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkin_config');
    }
};
