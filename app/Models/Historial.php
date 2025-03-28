<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla manualmente
    protected $table = 'historials';

    protected $fillable = [
        'user_id',
        'resumen_consultas',
        'recetas_medicamentos',
        'alergias_condiciones',
        'informes_hospitalizacion',
        'plan_tratamiento',
        'comunicaciones',
    ];

    // Relación con el usuario (paciente)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}