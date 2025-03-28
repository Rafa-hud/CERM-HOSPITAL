<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view("auth.login");
    }

    public function store(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'message' => 'Contraseña o algo mal :v',
            ]);
        }

        if (Auth::user()->role == "administrador") {
            return redirect()->route('cita.index');
        } elseif (Auth::user()->role == "Doctor") {
            return redirect()->route('delta.index');
        }

        // Redirigir a una ruta por defecto si el rol no coincide
        return redirect('/');
    }
}
