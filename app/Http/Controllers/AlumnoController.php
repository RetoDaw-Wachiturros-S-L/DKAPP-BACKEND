<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Evaluacion;
use App\Models\User;

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

    public function getAlumnoByUserId($id){
        $alumno = Alumno::with([
            'user',
            'ciclo',
            'cursos',
            'modulos.evaluaciones',
            'notasSeguimiento',
            'estanciaFormativa'
        ])->where('id_user', $id)->first();

        if (!$alumno) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json($alumno->InvokeObject());
    }

    public function nuevasNotas(Request $request) {
        $request->validate([
            'idAlumno' => 'required|integer|exists:alumnos,id',
            'idEstancia' => 'required|integer|exists:estancias_formativas,id',
            'notas' => 'required|array|min:1',
            'notas.*.id_modulo' => 'required|integer|exists:modulos,id',
            'notas.*.evaluaciones' => 'sometimes|array',
            'notas.*.evaluaciones.*.id' => 'required_with:notas.*.evaluaciones|integer|exists:evaluaciones,id',
            'notas.*.evaluaciones.*.nota_previa' => 'required_with:notas.*.evaluaciones|numeric|min:0|max:10',
            'notas.*.evaluaciones.*.observaciones' => 'nullable|string',
            'notas.*.nueva_evaluacion' => 'sometimes|array',
            'notas.*.nueva_evaluacion.nota_previa' => 'nullable|numeric|min:0|max:10',
            'notas.*.nueva_evaluacion.observaciones' => 'nullable|string',
        ]);

        $idEstancia = $request->idEstancia;

        foreach ($request->notas as $modulo) {

            // Actualizar evaluaciones existentes
            if (isset($modulo['evaluaciones'])) {
                foreach ($modulo['evaluaciones'] as $eva) {
                    Evaluacion::where('id', $eva['id'])
                        ->update([
                            'nota_previa' => $eva['nota_previa'],
                            'observaciones' => $eva['observaciones'],
                            'updated_at' => now(),
                        ]);
                }
            }

            if (isset($modulo['nueva_evaluacion'])) {
                // En caso de que las notas vengasn vacias, se salta la create
                if (
                        $modulo['nueva_evaluacion']['nota_previa'] === null &&
                        $modulo['nueva_evaluacion']['observaciones'] === null
                    ) continue;


                Evaluacion::create([
                    'id_estancia' => $idEstancia,
                    'id_modulo' => $modulo['id_modulo'],
                    'nota_previa' => $modulo['nueva_evaluacion']['nota_previa'],
                    'observaciones' => $modulo['nueva_evaluacion']['observaciones'],
                    'fecha_evaluacion' => now(),
                ]);
            }
        }

        return response()->json([
            'message' => 'Notas actualizadas correctamente'
        ]);
    }
}
