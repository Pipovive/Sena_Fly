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
       Schema::create('aviones', function (Blueprint $table) {
        $table->id();
        $table->string('matricula')->unique(); // HK-1234
        $table->foreignId('modelo_avion_id')->constrained('modelos_avion');
        $table->string('nombre_operador')->default('Avianca'); // simplificado
        $table->timestamps();
    });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aviones');
    }
};
