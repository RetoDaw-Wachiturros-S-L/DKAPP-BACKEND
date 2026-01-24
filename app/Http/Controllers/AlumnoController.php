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

        return response()->json(Alumno::find($alumno->id)->InvokeObject());
    }

    public function getAlumnoById($id)
    {
        $alumno = Alumno::with(['user', 'ciclo', 'notasSeguimiento'])->find($id);

        if (!$alumno) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json(Alumno::find($id)->InvokeObject());
    }
}
