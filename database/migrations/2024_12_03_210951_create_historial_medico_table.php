<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
{
    Schema::create('historial_medico', function (Blueprint $table) {
        $table->id();
        $table->foreignId('mascota_id')->constrained('mascotas')->onDelete('cascade');
        $table->date('fecha');
        $table->text('diagnostico');
        $table->text('tratamiento');
        $table->text('medicamentos');
        $table->string('veterinario')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_medico');
    }
};
