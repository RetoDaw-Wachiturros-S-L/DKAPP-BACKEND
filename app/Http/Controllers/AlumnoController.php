<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnoController extends Controller
{
    public function getAlumnoPorNombre(Request $request){
        $term = $request->query('nombre_completo');

        // Cargamos TODAS las relaciones necesarias
        $alumno = Alumno::with([
            'user',
            'ciclo',
            'cursos',
            'modulos.evaluaciones',
            'notasSeguimiento',
            'estanciaFormativa'
        ])
        ->whereHas('user', function($query) use ($term) {
            $query->whereRaw("CONCAT(nombre, ' ', apellidos) LIKE ?", ["%{$term}%"]);
        })
        ->first();

        if (!$alumno) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json($alumno->InvokeObject());
    }

    public function getAlumnoById($id){
        $alumno = Alumno::with([
            'user',
            'ciclo',
            'cursos',
            'modulos.evaluaciones',
            'notasSeguimiento',
            'estanciaFormativa'
        ])->find($id);

        if (!$alumno) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json($alumno->InvokeObject());
}
}
