<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Asegúrate de que este campo esté en la lista de fillable
        'curp',
        'email',
        'fecha_cita',
        'hora_cita',
        'motivo',
    ];

    // Relación con el modelo User (paciente)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el modelo CitaEstado
    public function estado()
    {
        return $this->hasOne(CitaEstado::class);
    }
}