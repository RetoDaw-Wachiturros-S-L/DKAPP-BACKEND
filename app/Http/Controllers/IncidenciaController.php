<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    // Listar todas las incidencias
    public function index()
    {
        $incidencias = Incidencia::with('emitente', 'inscripcion')->get();
        return response()->json($incidencias);
    }

    // Crear nueva incidencia
    public function store(Request $request)
    {
        $request->validate([
            'fecha_hora' => 'required|date',
            'tipo_incidencia' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'inscripcion_id' => 'required|exists:inscripciones,id',
        ]);

        $incidencia = Incidencia::create([
            'fecha_hora' => $request->fecha_hora,
            'tipo_incidencia' => $request->tipo_incidencia,
            'descripcion' => $request->descripcion,
            'inscripcion_id' => $request->inscripcion_id,
            'emitente_id' => auth()->id(), // <- aquí guardamos automáticamente el ID de la persona logueada
        ]);

        return response()->json($incidencia, 201);
    }


    // Mostrar una incidencia específica
    public function show($id)
    {
        $incidencia = Incidencia::with('emitente', 'inscripcion')->findOrFail($id);
        return response()->json($incidencia);
    }

    // Actualizar incidencia
    public function update(Request $request, $id)
    {
        $incidencia = Incidencia::findOrFail($id);

        $request->validate([
            'fecha_hora' => 'sometimes|date',
            'tipo_incidencia' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string',
            'inscripcion_id' => 'sometimes|exists:inscripciones,id',
        ]);

        $incidencia->update($request->all());
        return response()->json($incidencia);
    }

    // Eliminar incidencia
    public function destroy($id)
    {
        $incidencia = Incidencia::findOrFail($id);
        $incidencia->delete();
        return response()->json(null, 204);
    }
}
