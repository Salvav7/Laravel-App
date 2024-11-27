<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('citas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('mascota_id')->constrained('mascotas')->onDelete('cascade');
        $table->foreignId('servicio_id')->constrained('servicios')->onDelete('cascade');
        $table->date('fecha');
        $table->time('hora');
        $table->enum('estado', ['pendiente', 'realizado', 'cancelado'])->default('pendiente');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('citas');
}

};
