<?php

namespace App\Http\Controllers;

use App\Models\Diario;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\AcceptHeader;

class DiarioController extends Controller
{
    public function nuevaEntrada(Request $request){
        // Validar response
        $request->validate([
            'idAlumno' => 'required|integer',
            'idEstancia' => 'required|integer',
            'entrada' => 'required|array',
            'entrada.fecha' => 'required|date',
            'entrada.accion_legible' => 'required|string',
            'entrada.contenido' => 'required|string',
        ]);

        // Metodo para parsear accion de front a back y grabar en BDº
        $accionDB = Diario::$acciones[$request->entrada['accion_legible']] ?? null;

        if (!$accionDB) return response()->json(['error' => 'Accion invalida en BD'], 422);

        // Insertar en Diario de Alumno
        $entrada = Diario::create([
            'id_alumno' => $request->idAlumno,
            'id_estancia' => $request->idEstancia,
            'fecha' => $request->entrada['fecha'],
            'accion' => $accionDB,
            'contenido' => $request->entrada['contenido'],
        ]);

        return response()->json($entrada);
    }
}
