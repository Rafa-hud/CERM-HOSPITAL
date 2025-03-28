<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\CitaEstado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaEstadoController extends Controller
{
    // Mostrar todas las citas (para el doctor)
    public function index()
    {
        // Obtener todas las citas con la relación del usuario (paciente) y su estado
        $citas = Cita::with(['user', 'estado'])->get();

        return view('doctor.citas.index', compact('citas'));
    }

    // Mostrar el formulario para crear una nueva cita (para el doctor)
    public function create()
    {
        // Obtener todos los pacientes para asignar la cita
        $pacientes = User::where('role', 'paciente')->get();

        return view('doctor.citas.create', compact('pacientes'));
    }

    // Guardar una nueva cita (para el doctor)
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'user_id' => 'required|exists:users,id', // Asegurar que el paciente exista
            'curp' => 'required',
            'email' => 'required|email',
            'fecha_cita' => 'required|date',
            'hora_cita' => 'required',
            'motivo' => 'nullable',
        ]);

        // Crear la cita
        $cita = Cita::create([
            'user_id' => $request->user_id, // Asignar el paciente seleccionado
            'curp' => $request->curp,
            'email' => $request->email,
            'fecha_cita' => $request->fecha_cita,
            'hora_cita' => $request->hora_cita,
            'motivo' => $request->motivo,
        ]);

        // Crear el estado inicial de la cita (pendiente)
        CitaEstado::create([
            'cita_id' => $cita->id,
            'estado' => 'pendiente',
        ]);

        // Redirigir al listado de citas con un mensaje de éxito
        return redirect()->route('doctor.citas.index')->with('success', 'Cita creada exitosamente.');
    }

    // Mostrar los detalles de una cita específica (para el doctor)
    public function show(Cita $cita)
    {
        // Cargar la relación con el usuario (paciente) y el estado
        $cita->load(['user', 'estado']);

        return view('doctor.citas.show', compact('cita'));
    }

    // Mostrar el formulario para editar una cita existente (para el doctor)
    public function edit(Cita $cita)
    {
        // Obtener todos los pacientes para asignar la cita
        $pacientes = User::where('role', 'paciente')->get();

        return view('doctor.citas.edit', compact('cita', 'pacientes'));
    }

    // Actualizar una cita existente (para el doctor)
    public function update(Request $request, Cita $cita)
    {
        // Validar los datos del formulario
        $request->validate([
            'user_id' => 'required|exists:users,id', // Asegurar que el paciente exista
            'curp' => 'required',
            'email' => 'required|email',
            'fecha_cita' => 'required|date',
            'hora_cita' => 'required',
            'motivo' => 'nullable',
        ]);

        // Actualizar la cita
        $cita->update($request->all());

        // Redirigir al listado de citas con un mensaje de éxito
        return redirect()->route('doctor.citas.index')->with('success', 'Cita actualizada exitosamente.');
    }

    // Eliminar una cita (para el doctor)
    public function destroy(Cita $cita)
    {
        // Eliminar el estado de la cita primero
        $cita->estado()->delete();

        // Eliminar la cita
        $cita->delete();

        // Redirigir al listado de citas con un mensaje de éxito
        return redirect()->route('doctor.citas.index')->with('success', 'Cita eliminada exitosamente.');
    }

    // Actualizar el estado de las citas (para el doctor)
    public function updateEstado(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'citas' => 'required|array',
            'citas.*.id' => 'required|exists:citas,id',
            'citas.*.estado' => 'required|in:realizada,no_realizada,pendiente',
        ]);

        // Actualizar el estado de cada cita
        foreach ($request->citas as $citaData) {
            CitaEstado::updateOrCreate(
                ['cita_id' => $citaData['id']],
                ['estado' => $citaData['estado']]
            );
        }

        // Redirigir al listado de citas con un mensaje de éxito
        return redirect()->route('doctor.citas.index')->with('success', 'Estados de las citas actualizados exitosamente.');
    }
}