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
        Schema::create('pagos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('reserva_id')->constrained('reservas')->onDelete('cascade');
        $table->enum('metodo', ['tarjeta_credito', 'debito', 'pse']);
        $table->enum('estado', ['exitoso', 'rechazado'])->default('exitoso');
        $table->string('referencia')->nullable();
        $table->json('detalle')->nullable();
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
