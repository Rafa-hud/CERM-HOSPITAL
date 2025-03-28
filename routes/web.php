<?php

use App\Http\Controllers\CitaController;
// use App\Http\Controllers\DoctorController;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Paciente\PacienteController;
use App\Http\Controllers\UserImportController;
use App\Http\Controllers\UserExportController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\CitaEstadoController;
use App\Http\Controllers\BrazoRoboticoController;



// Este controlador se encarga de gestionar las citas del doctor






/*
|--------------------------------------------------------------------------
| Rutas Públicas (Accesibles sin autenticación)
|--------------------------------------------------------------------------
*/

// Ruta de inicio (formulario de login)
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.index');

// Ruta para procesar el login
Route::post('login', [LoginController::class, 'login'])->name('login.store');

// Ruta para mostrar el formulario de registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Ruta para procesar el registro
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

// Ruta para cerrar sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Rutas Protegidas para dashboards
|--------------------------------------------------------------------------
*/

// Ruta para el panel de Administrador
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


     // Rutas para brazos robóticos
     Route::prefix('brazos-roboticos')->name('brazos-roboticos.')->group(function () {
        Route::get('/', [BrazoRoboticoController::class, 'index'])->name('index');
        // ... otras rutas
    });


});

// Ruta para el panel de Doctor
Route::middleware(['auth', 'role:doctor'])->group(function () {

    // Ruta del dashboard del doctor
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');

    // Ruta para ver los reportes
    Route::get('/doctor/reportes', [DoctorController::class, 'reportes'])->name('doctor.reportes');

    // Rutas para gestionar el historial médico
    Route::prefix('doctor/historial')->name('doctor.historial.')->group(function () {
        // Listar todos los historiales médicos
        Route::get('/', [HistorialController::class, 'index'])->name('index');

        // Mostrar formulario para crear un nuevo historial médico
        Route::get('/create', [HistorialController::class, 'create'])->name('create');

        // Guardar un nuevo historial médico
        Route::post('/', [HistorialController::class, 'store'])->name('store');

        // Mostrar detalles de un historial médico específico
        Route::get('/{id}', [HistorialController::class, 'showDoctor'])->name('show');

        // Mostrar formulario para editar un historial médico existente
        Route::get('/{id}/edit', [HistorialController::class, 'edit'])->name('edit');

        // Actualizar un historial médico existente
        Route::put('/{id}', [HistorialController::class, 'update'])->name('update');

        // Eliminar un historial médico
        Route::delete('/{id}', [HistorialController::class, 'destroy'])->name('destroy');
    });

    // Rutas para gestionar las citas
    Route::prefix('doctor/citas')->name('doctor.citas.')->group(function () {
        // Listar todas las citas
        Route::get('/', [CitaEstadoController::class, 'index'])->name('index');

        // Mostrar formulario para crear una nueva cita
        Route::get('/create', [CitaEstadoController::class, 'create'])->name('create');

        // Guardar una nueva cita
        Route::post('/', [CitaEstadoController::class, 'store'])->name('store');

        // Mostrar detalles de una cita específica
        Route::get('/{id}', [CitaEstadoController::class, 'show'])->name('show');

        // Mostrar formulario para editar una cita existente
        Route::get('/{id}/edit', [CitaEstadoController::class, 'edit'])->name('edit');

        // Actualizar una cita existente
        Route::put('/{id}', [CitaEstadoController::class, 'update'])->name('update');

        // Eliminar una cita
        Route::delete('/{id}', [CitaEstadoController::class, 'destroy'])->name('destroy');

        // Actualizar el estado de las citas
        Route::post('/updateEstado', [CitaEstadoController::class, 'updateEstado'])->name('updateEstado');
    });
});

// Ruta para el panel de Paciente
Route::middleware(['auth', 'role:paciente'])->group(function () {
    // Ruta del dashboard del paciente
    Route::get('/paciente/dashboard', [PacienteController::class, 'dashboard'])->name('paciente.dashboard');

    // Rutas de citas para el paciente
    Route::prefix('paciente/citas')->group(function () {
        Route::get('/', [CitaController::class, 'index'])->name('paciente.citas.index'); // Listar citas
        Route::get('/create', [CitaController::class, 'create'])->name('paciente.citas.create'); // Mostrar formulario de creación
        Route::post('/', [CitaController::class, 'store'])->name('paciente.citas.store'); // Guardar nueva cita
        Route::get('/{cita}', [CitaController::class, 'show'])->name('paciente.citas.show'); // Mostrar detalles de una cita
        Route::get('/{cita}/edit', [CitaController::class, 'edit'])->name('paciente.citas.edit'); // Mostrar formulario de edición
        Route::put('/{cita}', [CitaController::class, 'update'])->name('paciente.citas.update'); // Actualizar cita
        Route::delete('/{cita}', [CitaController::class, 'destroy'])->name('paciente.citas.destroy'); // Eliminar cita
    });
});

/*
|--------------------------------------------------------------------------
| Rutas Protegidas por Autenticación y Roles
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Rutas para Usuarios
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('search', [UserController::class, 'search'])->name('search');
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('{user}', [UserController::class, 'show'])->name('show');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('{user}', [UserController::class, 'update'])->name('update');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');
    });


   // Rutas para brazos robóticos
   Route::prefix('brazos-roboticos')->name('brazos-roboticos.')->group(function () {
    Route::get('/', [BrazoRoboticoController::class, 'index'])->name('index');
    Route::get('create', [BrazoRoboticoController::class, 'create'])->name('create');
    Route::post('/', [BrazoRoboticoController::class, 'store'])->name('store');
    Route::get('{brazo_robotico}', [BrazoRoboticoController::class, 'show'])->name('show');
    Route::get('{brazo_robotico}/edit', [BrazoRoboticoController::class, 'edit'])->name('edit');
    Route::put('{brazo_robotico}', [BrazoRoboticoController::class, 'update'])->name('update');
    Route::delete('{brazo_robotico}', [BrazoRoboticoController::class, 'destroy'])->name('destroy');
});

    //Route::prefix('citas')->group(function () {
      //  Route::get('/', 'CitaController@index');
      //  Route::get('/{id}', 'CitaController@show');
       // Route::post('/', 'CitaController@store');
       // Route::put('/{id}', 'CitaController@update');
      //  Route::delete('/{id}', 'CitaController@destroy');
   // });

   // Route::prefix('historial-inyecciones')->group(function () {
     //   Route::get('/', 'HistorialInyeccionController@index');
       // Route::get('/{id}', 'HistorialInyeccionController@show');
      //  Route::post('/', 'HistorialInyeccionController@store');
      //  Route::put('/{id}', 'HistorialInyeccionController@update');
      //  Route::delete('/{id}', 'HistorialInyeccionController@destroy');
   // });

});



// Si necesitas rutas públicas o para otros roles, puedes agregar otro grupo aquí

// Grupo de rutas para el rol de doctor
Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/citas/search', [CitaController::class, 'search'])->name('citas.search');

    Route::get('citas', [CitaController::class, 'index'])->name('cita.index');
    Route::get('citas/create', [CitaController::class, 'create'])->name('citas.create');
    Route::post('citas', [CitaController::class, 'store'])->name('citas.store');
    Route::get('citas/{mostrar}', [CitaController::class, 'show'])->name('citas.show');
    Route::get('citas/{editar}/edit', [CitaController::class, 'edit'])->name('citas.edit');
    Route::put('citas/{editar}', [CitaController::class, 'update'])->name('citas.update');
    Route::delete('citas/{eliminar}', [CitaController::class, 'destroy'])->name('citas.destroy');
});

// Grupo de rutas para el rol de paciente
Route::middleware(['auth', 'role:paciente'])->group(function () {
    // Ruta principal del paciente
    Route::get('paciente', [CitaController::class, 'vista'])->name('paciente.index');

    // Rutas de citas para el paciente
    Route::prefix('citas')->group(function () {
        Route::get('/', [CitaController::class, 'index'])->name('paciente.citas.index'); // Listar citas
        Route::get('/create', [CitaController::class, 'create'])->name('paciente.citas.create'); // Mostrar formulario de creación
        Route::post('/', [CitaController::class, 'store'])->name('paciente.citas.store'); // Guardar nueva cita
        Route::get('/{cita}', [CitaController::class, 'show'])->name('paciente.citas.show'); // Mostrar detalles de una cita
        Route::get('/{cita}/edit', [CitaController::class, 'edit'])->name('paciente.citas.edit'); // Mostrar formulario de edición
        Route::put('/{cita}', [CitaController::class, 'update'])->name('paciente.citas.update'); // Actualizar cita
        Route::delete('/{cita}', [CitaController::class, 'destroy'])->name('paciente.citas.destroy'); // Eliminar cita
    });

     // Ruta para ver el historial del paciente
     Route::get('historial/{id}', [HistorialController::class, 'show'])->name('paciente.historial.show');
    });

    // Grupo de rutas para el rol de doctor
    Route::middleware(['auth', 'role:doctor'])->group(function () {
        // Rutas de historial para el doctor
        Route::prefix('doctor/historial')->group(function () {
            Route::get('/{id}/edit', [HistorialController::class, 'edit'])->name('doctor.historial.edit');
            Route::put('/{id}', [HistorialController::class, 'update'])->name('doctor.historial.update');
            Route::delete('/{id}', [HistorialController::class, 'destroy'])->name('doctor.historial.destroy');
        });



});


// Importar Exel
Route::post('/import-users', [UserImportController::class, 'import'])->name('import.users');
// Exportar Exel
Route::get('/export-users', [UserExportController::class, 'export'])->name('export.users');
