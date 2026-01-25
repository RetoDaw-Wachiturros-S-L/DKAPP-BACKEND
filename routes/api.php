<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TutorCentroController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DiarioController;
use App\Http\Controllers\EmpresaController;

// Login
Route::post('/login', [LoginController::class, 'login']);

// Obtner allumnos - datos - crear entradas de diario
Route::get('mis-alumnos/{idTutor}', [TutorCentroController::class, 'getAlumnos']);

// Obtener tutores de un alumno
Route::get('mis-tutores/{idAlumno}', [TutorCentroController::class, 'getTutores']);

// Mandar incidencias a backend
Route::post('/incidencias', [IncidenciaController::class, 'store']);

// Obtener alumnos e info de uno solo (id)
Route::get('/alumno/auto-completa', [AlumnoController::class, 'getAlumnoPorNombre']);
Route::get('/alumno/{id}', [AlumnoController::class, 'getAlumnoById']);

// Entradas de diario de alumno
Route::post('alumno/nuevaEntrada', [DiarioController::class, 'nuevaEntrada']);



Route::get('/empresa/{empresaId}/tutores', [EmpresaController::class, 'tutores']);


Route::get('/empresas', [EmpresaController::class, 'index']);

