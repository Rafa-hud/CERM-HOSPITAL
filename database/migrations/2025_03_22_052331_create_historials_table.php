<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialsTable extends Migration
{
    public function up()
    {
        Schema::create('historials', function (Blueprint $table) {
            $table->id(); // Columna de ID autoincremental
            $table->unsignedBigInteger('user_id'); // Relación con el usuario (paciente)
            $table->text('resumen_consultas')->nullable(); // Resumen de consultas médicas
            $table->text('recetas_medicamentos')->nullable(); // Recetas y medicamentos
            $table->text('alergias_condiciones')->nullable(); // Alergias y condiciones crónicas
            $table->text('informes_hospitalizacion')->nullable(); // Informes de hospitalización
            $table->text('plan_tratamiento')->nullable(); // Plan de tratamiento
            $table->text('comunicaciones')->nullable(); // Comunicaciones
            $table->timestamps(); // Columnas created_at y updated_at

            // Clave foránea para la relación con la tabla `users`
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historials'); // Eliminar la tabla si se revierte la migración
    }
}