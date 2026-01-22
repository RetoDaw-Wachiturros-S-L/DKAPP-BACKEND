<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    // Listar todas las incidencias - Para admin (opc)
    public function index()
    {
        // No forzamos la relación `inscripcion` si la tabla/Modelo no existe en la BD actual
        $incidencias = Incidencia::with('emitente')->get();
        return response()->json($incidencias);
    }

    public function whoami()
    {
        $user = auth()->user();
        return response()->json($user); 
    }

    // Crear nueva incidencia
    public function store(Request $request)
    {
        $request->validate([
            'fecha_hora' => 'required|date',
            'tipo_incidencia' => 'required|string',
            'descripcion' => 'required|string', 
        ]);

        try {
            $incidencia = Incidencia::create([
                'fecha_hora' => $request->fecha_hora,
                'tipo_incidencia' => $request->tipo_incidencia,
                'descripcion' => $request->descripcion,
                'emitente_id' => $request->id_usuario 
            ]);

            return response()->json($incidencia, 201);
        } catch (\Exception $e) {
            // Devolvemos el error real para que lo veas en la consola de Vue
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    // Mostrar una incidencia específica
    public function show($id)
    {
        $incidencia = Incidencia::with('emitente')->findOrFail($id);
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
        ]);
        // No permitimos actualizar el emitente desde el request por seguridad
        $data = $request->only(['fecha_hora', 'tipo_incidencia', 'descripcion']);

        $incidencia->update($data);
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
