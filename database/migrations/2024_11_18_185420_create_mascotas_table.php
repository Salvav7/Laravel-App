<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMascotasTable extends Migration
{
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id('id');
            $table->string('nombre');
            $table->integer('edad')->nullable();
            $table->string('raza')->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->string('nombre_duenio')->nullable();
            $table->string('telefono_duenio')->nullable();
            $table->string('imagen_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mascotas');
    }

};
