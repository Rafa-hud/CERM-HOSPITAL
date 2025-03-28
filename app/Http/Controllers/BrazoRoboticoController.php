<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api\BrazoRobotico;
use Illuminate\Support\Facades\Http;


class BrazoRoboticoController extends Controller
{
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = env('API_BASE_URL', 'http://localhost:5000');
    }

    public function index()
{
    try {
        $response = Http::get(env('API_BASE_URL').'/brazos-roboticos');
        
        if ($response->successful()) {
            $brazos = $response->json();
            return view('brazos-roboticos.index', compact('brazos'));
        }

        // Si la API responde pero con error
        $error = $response->json()['error'] ?? 'Error al obtener los brazos robóticos';
        return view('brazos-roboticos.index', ['brazos' => []])
            ->with('error', $error);

    } catch (\Exception $e) {
        // Si hay un error de conexión con la API
        return view('brazos-roboticos.index', ['brazos' => []])
            ->with('error', 'No se pudo conectar con el servidor de la API');
    }
}

    public function store(Request $request)
{
    $request->validate([
        'modelo' => 'required|string|max:255',
        'fabricante' => 'required|string|max:255',
        'user_id' => 'nullable|integer'
    ]);

    $response = Http::post(env('API_BASE_URL').'/brazos-roboticos', [
        'modelo' => $request->modelo,
        'fabricante' => $request->fabricante,
        'user_id' => $request->user_id
    ]);

    if ($response->successful()) {
        return redirect()->route('brazos-roboticos.index')
            ->with('success', 'Brazo robótico creado exitosamente');
    }

    return back()->withInput()
        ->with('error', 'Error al crear el brazo robótico: '.($response->json()['error'] ?? 'Error desconocido'));
}

    
    public function create()
    {
        return view('brazos-roboticos.create');
    }

    

    public function show($id)
    {
        $brazo = BrazoRobotico::find($id);
        
        if ($brazo) {
            return view('brazos-roboticos.show', compact('brazo'));
        }

        return back()->with('error', 'Brazo robótico no encontrado');
    }

    public function edit($id)
    {
        $brazo = BrazoRobotico::find($id);
        
        if ($brazo) {
            return view('brazos-roboticos.edit', compact('brazo'));
        }

        return back()->with('error', 'Brazo robótico no encontrado');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'modelo' => 'required|string|max:255',
            'fabricante' => 'required|string|max:255',
            'user_id' => 'nullable|numeric'
        ]);

        $response = BrazoRobotico::update($id, $request->all());

        if ($response->successful()) {
            return redirect()->route('brazos-roboticos.show', $id)
                ->with('success', 'Brazo robótico actualizado exitosamente');
        }

        return back()->with('error', 'Error al actualizar el brazo robótico');
    }

    public function destroy($id)
    {
        $response = BrazoRobotico::delete($id);

        if ($response->successful()) {
            return redirect()->route('brazos-roboticos.index')
                ->with('success', 'Brazo robótico eliminado exitosamente');
        }

        return back()->with('error', 'Error al eliminar el brazo robótico');
    }
}