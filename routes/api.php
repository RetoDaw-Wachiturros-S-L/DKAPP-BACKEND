<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TutorCentroController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DiarioController;
use App\Http\Controllers\EmpresaController;
use Laravel\Mcp\Enums\Role;
use App\Http\Controllers\CompetenciaController;
use App\Http\Controllers\EstanciaFormativaController;
use App\Http\Controllers\EstanciaCompetenciaController;


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
Route::get('/user-alumno/{id}', [AlumnoController::class, 'getAlumnoByUserId']);

// Entradas de diario de alumno
Route::post('alumno/nuevaEntrada', [DiarioController::class, 'nuevaEntrada']);

Route::get('/empresa/{empresaId}/tutores', [EmpresaController::class, 'tutores']);
Route::get('/empresas', [EmpresaController::class, 'index']);

Route::post('alumno/nuevas-notas', [AlumnoController::class, 'nuevasNotas']);

Route::get('/competencias', [CompetenciaController::class, 'index']);

Route::post('/estancias', [EstanciaFormativaController::class, 'store']);
Route::post('/estancia-competencias/bulk', [EstanciaCompetenciaController::class, 'storeBulk']);