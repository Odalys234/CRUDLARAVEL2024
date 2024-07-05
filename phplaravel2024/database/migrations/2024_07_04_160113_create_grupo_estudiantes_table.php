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
        Schema::create('estudiante_grupo', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('grupo_id');
            $table->unsignedInteger('estudiante_id');
            $table->foreign('grupo_id')->references('id')->on('grupo');
            $table->foreign('estudiante_id')->references('id')->on('estudiante');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiante_grupo');
    }
};
