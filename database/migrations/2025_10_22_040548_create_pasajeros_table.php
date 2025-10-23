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
        $table->foreignId('reserva_id')->constrained('reservas')->onDelete('cascade');

        // Datos personales
        $table->string('nombre');
        $table->string('apellido');
        $table->enum('genero', ['M', 'F', 'O']);
        $table->date('fecha_nacimiento');

        // Documento
        $table->enum('tipo_documento', ['CC', 'TI', 'CE', 'Pasaporte']);
        $table->string('numero_documento');

        // Contacto del pasajero (opcional si lo tiene)
        $table->string('email')->nullable();
        $table->string('telefono')->nullable();

        // Campo calculado (menor de edad o no)
        $table->boolean('es_menor')->default(false);
        $table->string('asiento'); // A1, B3, etc.

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
