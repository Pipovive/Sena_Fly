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
        Schema::create('reserva_pasajero', function (Blueprint $table) {
        $table->id();
        $table->foreignId('reserva_id')->constrained('reservas')->onDelete('cascade');
        $table->foreignId('vuelo_id')->constrained('vuelos');
        $table->foreignId('pasajero_id')->constrained('pasajeros')->onDelete('cascade');
        $table->string('asiento');
        $table->string('clase')->default('económica');
        $table->decimal('precio', 10, 2);
        $table->timestamps();

        // ⚠️ Evita venta doble del mismo asiento en el mismo vuelo
        $table->unique(['vuelo_id', 'asiento']);
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva_pasajero');
    }
};
