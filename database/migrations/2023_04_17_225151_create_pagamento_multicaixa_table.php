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
        Schema::create('pagamento_multicaixa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPagamento');
            $table->string('entidade', 10);
            $table->string('referencia', 20);
            $table->decimal('montante', 12,2);
            $table->string('nome', 155);
            $table->string('descricao', 255);
            $table->string('telefone', 20);
            $table->date('dataLimite');
            $table->dateTime('dataPagamento')->nullable();
            $table->string('localPagamento')->nullable();
            $table->dateTime('voided_at')->nullable();
            $table->string('idTimebox', 50)->nullable();
            $table->text('timeboxData')->nullable();
            $table->timestamps();

            $table->foreign('idPagamento')->references('id')->on('pagamento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamento_multicaixa');
    }
};
