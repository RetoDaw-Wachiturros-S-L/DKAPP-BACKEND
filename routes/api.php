<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TutorCentroController;
use Illuminate\Support\Facades\Route;

// Login
Route::post('/login', [LoginController::class, 'login']);

// Obtner allumnos - datos - crear entradas de diario
Route::get('mis-alumnos/{idTutor}', [TutorCentroController::class, 'getAlumnos']);

// Obtener tutores de un alumno
Route::get('mis-tutores/{idAlumno}', [TutorCentroController::class, 'getTutores']);
