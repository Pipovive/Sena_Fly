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
        Schema::create('vuelos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('origen_id')->constrained('ciudades');
        $table->foreignId('destino_id')->constrained('ciudades');
        $table->foreignId('avion_id')->constrained('aviones');
        $table->date('fecha');
        $table->time('hora_salida');
        $table->time('hora_llegada')->nullable();
        $table->decimal('precio', 10, 2);
        $table->enum('estado', ['programado', 'demorado', 'cancelado'])->default('programado');
        $table->timestamps();
    });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vuelos');
    }
};
