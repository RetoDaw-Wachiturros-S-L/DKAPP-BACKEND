<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstanciaFormativa;
use Illuminate\Support\Facades\DB;

class EstanciaFormativaController extends Controller
{
   public function store(Request $request)
{
    try {
        return DB::transaction(function () use ($request) {
            $estancia = EstanciaFormativa::create([
            'id_alumno'        => $request->id_alumno,
            'id_empresa'       => $request->id_empresa,
            // CAMBIO AQUÍ: Si es 0 o está vacío, mandamos NULL
            'id_tutor_empresa' => $request->id_tutor_empresa ?: null, 
            'id_tutor_centro'  => $request->id_tutor_centro ?: null,
            'id_curso'         => $request->id_curso ?: null,
            'fecha_inicio'     => null,
            'fecha_fin'        => null,
            'horas_totales'    => $request->horas_totales ?? 0,
            'horas_realizadas' => 0,
            'estado'           => 'PLANIFICADA',
            ]);

            if (!empty($request->competencias)) {
                $datosPivot = [];
                foreach ($request->competencias as $idCompetencia) {
                    $datosPivot[$idCompetencia] = [
                        'numero_semana' => 13, // <--- Solución al error 1364
                        'fecha_inicio'  => null,
                        'fecha_fin'     => null,
                    ];
                }
                $estancia->competencias()->attach($datosPivot);
            }

            return response()->json(['message' => 'Creado con éxito', 'id' => $estancia->id], 201);
        });
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}