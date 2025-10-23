<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('asientos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('avion_id')->constrained('aviones')->onDelete('cascade');
        $table->string('codigo'); // Ej: 1A, 1B, 2A
        $table->enum('clase', ['económica', 'business'])->default('económica');
        $table->boolean('disponible')->default(true);
        $table->timestamps();

        $table->unique(['avion_id', 'codigo']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asientos');
    }
};
