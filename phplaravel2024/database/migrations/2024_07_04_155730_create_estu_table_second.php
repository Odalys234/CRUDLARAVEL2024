<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudiante', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('pin');
            $table->timestamps(); // Añade created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estudiante');
    }
};

