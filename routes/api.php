<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TutorCentroController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\EstanciaFormativaController;
// Login
Route::post('/login', [LoginController::class, 'login']);

// Obtner allumnos - datos - crear entradas de diario
Route::get('mis-alumnos/{idTutor}', [TutorCentroController::class, 'getAlumnos']);

// Obtener tutores de un alumno
Route::get('mis-tutores/{idAlumno}', [TutorCentroController::class, 'getTutores']);



Route::post('/incidencias', [IncidenciaController::class, 'store']);

Route::get('/whoami', [IncidenciaController::class, 'whoami']);


Route::get('/alumno/auto-completa', [AlumnoController::class, 'getAlumnoPorNombre']);
Route::get('/alumno/{id}', [AlumnoController::class, 'getAlumnoById']);
// Alias para coincidir con el frontend
Route::get('/alumnos/{id}', [AlumnoController::class, 'getAlumnoById']);

// Estancias Formativas
Route::prefix('alumnos/{idAlumno}')->group(function () {
    Route::get('estancias-formativas', [EstanciaFormativaController::class, 'obtenerPorAlumno']);
});

Route::prefix('estancias-formativas/{idEstancia}')->group(function () {
    Route::get('horarios', [EstanciaFormativaController::class, 'obtenerHorarios']);
    Route::post('horarios', [EstanciaFormativaController::class, 'crearHorario']);
    Route::put('horarios/{idHorario}', [EstanciaFormativaController::class, 'actualizarHorario']);
    Route::delete('horarios/{idHorario}', [EstanciaFormativaController::class, 'eliminarHorario']);

    Route::get('vacaciones', [EstanciaFormativaController::class, 'obtenerVacaciones']);
    Route::post('vacaciones', [EstanciaFormativaController::class, 'registrarVacaciones']);

    Route::get('notas', [EstanciaFormativaController::class, 'obtenerNotas']);
    Route::post('notas', [EstanciaFormativaController::class, 'crearNota']);
    Route::put('notas/{idNota}', [EstanciaFormativaController::class, 'actualizarNota']);
    Route::delete('notas/{idNota}', [EstanciaFormativaController::class, 'eliminarNota']);

    Route::put('progreso', [EstanciaFormativaController::class, 'actualizarProgreso']);
    Route::put('fechas', [EstanciaFormativaController::class, 'actualizarFechas']);
});