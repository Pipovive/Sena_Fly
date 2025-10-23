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
        $table->string('codigo_reserva')->unique();
        $table->foreignId('vuelo_id')->constrained('vuelos')->onDelete('cascade');
        $table->string('nombre_titular');
        $table->string('apellido_titular');
        $table->string('email_titular');
        $table->string('telefono_titular')->nullable();
        $table->enum('estado', ['pendiente', 'pagada', 'cancelada'])->default('pendiente');
        $table->integer('cantidad_pasajeros')->default(1);
        $table->decimal('total_pagado', 10, 2)->nullable();
        $table->timestamps();
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
