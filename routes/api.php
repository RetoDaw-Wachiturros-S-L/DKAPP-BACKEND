<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TutorCentroController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidenciaController;

// Login
Route::post('/login', [LoginController::class, 'login']);

// Obtner allumnos - datos - crear entradas de diario
Route::get('mis-alumnos/{idTutor}', [TutorCentroController::class, 'getAlumnos']);

// Obtener tutores de un alumno
Route::get('mis-tutores/{idAlumno}', [TutorCentroController::class, 'getTutores']);



Route::post('/incidencias', [IncidenciaController::class, 'store']);

Route::get('/whoami', [IncidenciaController::class, 'whoami']);