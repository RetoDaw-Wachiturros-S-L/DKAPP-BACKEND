<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TutorCentroController extends Controller
{
    public function getAlumnos($idTutor){
        $tutor = User::find($idTutor);
        // Obtiene todos los alumnos , practicas y empresas de los alumons de ese tutor
        $estanciaFormativa = $tutor->practicasTutorCentro()->with('alumno.user', 'empresa', 'curso')->get();

        foreach($estanciaFormativa as $estancia){
            $alumnos[] = [
                'id' => $estancia->alumno->id,
                'nombre' => $estancia->alumno->user->nombre,
                'apellidos' => $estancia->alumno->user->apellidos,
                'email' => $estancia->alumno->user->email,
                'telefono' => $estancia->alumno->user->telefono,
                'empresa' => $estancia->empresa ? $estancia->empresa->nombre : null,
                'curso' => $estancia->curso ? $estancia->curso->nombre : null,
                'fecha_inicio' => $estancia->fecha_inicio,
                'fecha_fin' => $estancia->fecha_fin,
                'estado' => $estancia->estado,
            ];
        }


        return response()->json($alumnos);
    }
}

