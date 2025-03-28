<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Columna para asociar la cita con un usuario
            $table->string('curp');
            $table->string('email');
            $table->date('fecha_cita');
            $table->time('hora_cita');
            $table->text('motivo')->nullable();
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('citas');
    }
}