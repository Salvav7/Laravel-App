<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('adopcion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mascota_id')->constrained('mascotas')->onDelete('cascade');
            $table->date('adopcion');
            $table->text('peso');
            $table->text('talla');
            $table->text('contacto');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('adopcion');
    }
};
