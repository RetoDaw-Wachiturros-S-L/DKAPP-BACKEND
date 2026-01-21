<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\User;

class TutorCentroController extends Controller
{
    public function getAlumnos($idTutor)
    {
        $tutor = User::find($idTutor);
        // Obtiene todos los alumnos , practicas y empresas de los alumons de ese tutor
        $estanciaFormativa = $tutor->practicasTutorCentro()->with('alumno.user', 'empresa', 'curso')->get();

        foreach ($estanciaFormativa as $estancia) {
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

    public function getTutores($idAlumno)
    {
        // En frontend se está enviando el id del usuario (User.id),
        // no el id del registro en la tabla alumnos, así que buscamos por id_user.
        $alumno = Alumno::where('id_user', $idAlumno)->first();

        if (!$alumno) {
            return response()->json([
                'message' => 'Alumno no encontrado para el usuario indicado',
            ], 404);
        }

        $tutores = $alumno->tutores()->with('user')->get()->map(function ($tutor){
        // Obtiene los datos de los tutores del centro en base a los id devueltos de alumno->tutores y luego con ese id obtiene los demas datos
        return [
                'id' => $tutor->id,
                'nombre'=> $tutor->user->nombre,
                'apellidos'=> $tutor->user->apellidos,
                'email'=> $tutor->user->email,
                'telefono'=> $tutor->user->telefono,
                'dni' => $tutor->dni,
            ];
        });

        return response()->json($tutores);
    }
}
