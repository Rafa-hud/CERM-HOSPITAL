<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasEstadosTable extends Migration
{
    public function up()
    {
        Schema::create('citas_estados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_id')->constrained('citas')->onDelete('cascade');
            $table->string('estado')->default('pendiente'); // Puede ser 'realizada', 'no_realizada', 'pendiente'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('citas_estados');
    }
}