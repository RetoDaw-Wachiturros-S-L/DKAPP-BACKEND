<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnoController extends Controller
{
    public function getAlumnoPorNombre(Request $request)
    {
        $term = $request->query('nombre_completo');

        // Cargamos 'user' y 'ciclo' (el ciclo nos dará el nombre y la familia)
        $alumno = Alumno::with(['user', 'ciclo'])
            ->whereHas('user', function($query) use ($term) {
                $query->whereRaw("CONCAT(nombre, ' ', apellidos) LIKE ?", ["%{$term}%"]);
            })
            ->first();

        if (!$alumno) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

<<<<<<< HEAD
        return response()->json([
            'id'        => $alumno->id,
            'nombre'    => $alumno->user->nombre,
            'apellidos' => $alumno->user->apellidos,
            'email'     => $alumno->user->email,
            'telefono'  => $alumno->user->telefono,
            'poblacion' => $alumno->poblacion,
            
            'curso'     => $alumno->curso_actual, 
            'ciclo'     => $alumno->ciclo ? $alumno->ciclo->nombre : 'Sin ciclo',
            'familia'   => $alumno->ciclo ? $alumno->ciclo->familia_profesional : 'Sin familia', 
            
        ]);
=======
        return response()->json(Alumno::find($alumno->id)->InvokeObject());
>>>>>>> e6498a92afbd6f5b34daaf60621a239ef5b2a2f7
    }

    public function getAlumnoById($id)
    {
        $alumno = Alumno::with(['user', 'ciclo'])->find($id);

        if (!$alumno) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json(Alumno::find($id)->InvokeObject());
    }
}
