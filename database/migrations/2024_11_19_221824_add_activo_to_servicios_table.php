<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActivoToServiciosTable extends Migration
{
    public function up()
    {
        Schema::table('servicios', function (Blueprint $table) {
            $table->boolean('activo')->default(true)->after('precio');
        });
    }

    public function down()
    {
        Schema::table('servicios', function (Blueprint $table) {
            $table->dropColumn('activo');
        });
    }
}
