<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitaEstado extends Model
{
    use HasFactory;

    protected $fillable = [
        'cita_id',
        'estado',
    ];

    // Relación con el modelo Cita
    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }
}