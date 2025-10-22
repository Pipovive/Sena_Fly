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
        Schema::create('pasajeros', function (Blueprint $table) {
        $table->id();
        $table->string('nombres');
        $table->string('apellidos');
        $table->date('fecha_nacimiento');
        $table->enum('genero', ['M', 'F', 'Otro']);
        $table->string('tipo_documento', 10);
        $table->string('numero_documento');
        $table->boolean('es_infante')->default(false);
        $table->string('email')->nullable();
        $table->string('telefono')->nullable();
        $table->timestamps();
    });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasajeros');
    }
};
