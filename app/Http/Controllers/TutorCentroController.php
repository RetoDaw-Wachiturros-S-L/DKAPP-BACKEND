<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TutorCentroController extends Controller
{
    public function getAlumnos($idTutor){
        $tutor = User::find($idTutor);
        // Obtiene todos los alumnos , practicas y empresas de los alumons de ese tutor
        $alumnos = $tutor->practicasTutorCentro()->with('alumno.user', 'empresa', 'curso')->get();

        return response()->json($alumnos);
    }
}

