<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    // Mostrar todas las citas del paciente autenticado
    public function index()
    {
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Filtrar las citas del usuario autenticado
        $citas = Cita::where('user_id', $userId)->get();

        return view('paciente.citas.index', compact('citas'));
    }

    // Mostrar el formulario para crear una nueva cita
    public function create()
    {
        return view('paciente.citas.create');
    }

    // Guardar una nueva cita
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'curp' => 'required',
            'email' => 'required|email',
            'fecha_cita' => 'required|date',
            'hora_cita' => 'required',
            'motivo' => 'nullable',
        ]);

        // Crear la cita asociada al usuario autenticado
        Cita::create([
            'user_id' => Auth::id(), // Asociar la cita al usuario autenticado
            'curp' => $request->curp,
            'email' => $request->email,
            'fecha_cita' => $request->fecha_cita,
            'hora_cita' => $request->hora_cita,
            'motivo' => $request->motivo,
        ]);

        // Redirigir al listado de citas con un mensaje de éxito
        return redirect()->route('paciente.citas.index')->with('success', 'Cita creada exitosamente.');
    }

    // Mostrar los detalles de una cita específica
    public function show(Cita $cita)
    {
        // Verificar que la cita pertenezca al usuario autenticado
        if ($cita->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver esta cita.');
        }

        return view('paciente.citas.show', compact('cita'));
    }

    // Mostrar el formulario para editar una cita
    public function edit(Cita $cita)
    {
        // Verificar que la cita pertenezca al usuario autenticado
        if ($cita->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta cita.');
        }

        return view('paciente.citas.edit', compact('cita'));
    }

    // Actualizar una cita existente
    public function update(Request $request, Cita $cita)
    {
        // Verificar que la cita pertenezca al usuario autenticado
        if ($cita->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar esta cita.');
        }

        // Validar los datos del formulario
        $request->validate([
            'curp' => 'required',
            'email' => 'required|email',
            'fecha_cita' => 'required|date',
            'hora_cita' => 'required',
            'motivo' => 'nullable',
        ]);

        // Actualizar la cita
        $cita->update($request->all());

        // Redirigir al listado de citas con un mensaje de éxito
        return redirect()->route('paciente.citas.index')->with('success', 'Cita actualizada exitosamente.');
    }

    // Eliminar una cita
    public function destroy(Cita $cita)
    {
        // Verificar que la cita pertenezca al usuario autenticado
        if ($cita->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar esta cita.');
        }

        // Eliminar la cita
        $cita->delete();

        // Redirigir al listado de citas con un mensaje de éxito
        return redirect()->route('paciente.citas.index')->with('success', 'Cita eliminada exitosamente.');
    }
}