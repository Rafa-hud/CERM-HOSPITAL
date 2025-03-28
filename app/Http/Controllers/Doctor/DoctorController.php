<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Medicamento;
use App\Models\User;


use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function dashboard()
    {
        return view('doctor.dashboard'); // Vista del panel de doctor
    }
    public function reportes()
{
    // Obtener datos de citas exitosas (esto es un ejemplo)
    $citasExitosas = [
        'Enero' => 12,
        'Febrero' => 19,
        'Marzo' => 3,
        'Abril' => 5,
        'Mayo' => 2,
        'Junio' => 3,
        'Julio' => 15,
    ];

    // Pasar los datos a la vista
    return view('doctor.reportes', compact('citasExitosas'));
}
}