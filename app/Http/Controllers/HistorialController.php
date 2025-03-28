<?php


namespace App\Http\Controllers;

use App\Models\Historial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    // Mostrar el historial del paciente (para pacientes)
    public function show($id)
    {
        // Verificar que el usuario autenticado sea el dueño del historial
        if (Auth::id() != $id) {
            abort(403, 'No tienes permiso para ver este historial.');
        }

        // Obtener el historial del paciente
        $historial = Historial::where('user_id', $id)->firstOrFail();

        // Mostrar la vista
        return view('paciente.historial.show', compact('historial'));
    }

    // Listar todos los historiales de pacientes (para doctores)
    public function index()
    {
        // Obtener todos los historiales con la información del usuario
        $historiales = Historial::with('user')->get();

        // Mostrar la vista
        return view('doctor.historial.index', compact('historiales'));
    }

    // Mostrar el formulario de creación de historial (para doctores)
    public function create()
{
    $pacientes = User::where('role', 'paciente')->get(); // Obtener solo pacientes
    return view('doctor.historial.create', compact('pacientes'));
}

    // Guardar el historial (para doctores)
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'resumen_consultas' => 'nullable|string',
            'recetas_medicamentos' => 'nullable|string',
            'alergias_condiciones' => 'nullable|string',
            'informes_hospitalizacion' => 'nullable|string',
            'plan_tratamiento' => 'nullable|string',
            'comunicaciones' => 'nullable|string',
        ]);

        Historial::create($request->all());

        return redirect()->route('doctor.historial.index')
                         ->with('success', 'Historial creado exitosamente.');
    }

    // Mostrar el historial de un paciente específico (para doctores)
    public function showDoctor($id)
    {
        // Obtener el historial con la información del usuario
        $historial = Historial::with('user')->findOrFail($id);

        // Mostrar la vista
        return view('doctor.historial.show', compact('historial'));
    }

    // Mostrar el formulario de edición (solo para doctores)
    public function edit($id)
    {
        $historial = Historial::findOrFail($id);
        $pacientes = User::where('role', 'paciente')->get();
        return view('doctor.historial.edit', compact('historial', 'pacientes'));
    }

    // Actualizar el historial (solo para doctores)
    public function update(Request $request, $id)
    {
        $historial = Historial::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'resumen_consultas' => 'nullable|string',
            'recetas_medicamentos' => 'nullable|string',
            'alergias_condiciones' => 'nullable|string',
            'informes_hospitalizacion' => 'nullable|string',
            'plan_tratamiento' => 'nullable|string',
            'comunicaciones' => 'nullable|string',
        ]);

        $historial->update($request->all());

        return redirect()->route('doctor.historial.show', $historial->id)
                         ->with('success', 'Historial actualizado exitosamente.');
    }

    // Eliminar el historial (solo para doctores)
    public function destroy($id)
    {
        $historial = Historial::findOrFail($id);
        $historial->delete();

        return redirect()->route('doctor.historial.index')
                         ->with('success', 'Historial eliminado exitosamente.');
    }
}