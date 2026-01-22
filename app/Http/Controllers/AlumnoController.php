<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnoController extends Controller
{
    public function getAlumnoPorNombre(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string',
        ]);

        $nombreCompleto = $request->nombre_completo;

        // Buscar alumno donde la combinación nombre + ' ' + apellidos coincida
        $alumno = Alumno::with('user')
            ->whereHas('user', function($query) use ($nombreCompleto) {
                $query->whereRaw("CONCAT(nombre, ' ', apellidos) = ?", [$nombreCompleto]);
            })
            ->first();

        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        return response()->json([
            'id' => $alumno->id,
            'nombre' => $alumno->user->nombre,
            'apellidos' => $alumno->user->apellidos,
            'email' => $alumno->user->email,
            'telefono' => $alumno->user->telefono,
            'poblacion' => $alumno->poblacion,
            'curso_actual' => $alumno->curso_actual,
            'id_ciclo' => $alumno->id_ciclo,
        ]);
    }
}
