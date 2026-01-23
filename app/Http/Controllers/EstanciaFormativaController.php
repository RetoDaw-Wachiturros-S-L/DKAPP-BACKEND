<?php

namespace App\Http\Controllers;

use App\Models\EstanciaFormativa;
use App\Models\HorarioEstancia;
use App\Models\NotaSeguimiento;
use Illuminate\Http\Request;

class EstanciaFormativaController extends Controller
{
    /**
     * Obtener estancias de un alumno
     */
    public function obtenerPorAlumno($idAlumno)
    {
        $estancias = EstanciaFormativa::where('id_alumno', $idAlumno)
            ->with(['empresa', 'tutor_empresa', 'tutor_centro', 'curso'])
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        return response()->json($estancias);
    }

    /**
     * Obtener horarios de una estancia
     */
    public function obtenerHorarios($idEstancia)
    {
        $horarios = HorarioEstancia::where('id_estancia', $idEstancia)
            ->orderBy('dia_semana')
            ->get();

        return response()->json($horarios);
    }

    /**
     * Crear horario
     */
    public function crearHorario(Request $request, $idEstancia)
    {
        $validated = $request->validate([
            'dia_semana' => 'required|in:LUNES,MARTES,MIERCOLES,JUEVES,VIERNES,SABADO,DOMINGO',
            'turno' => 'required|in:MAÑANA,TARDE,NOCHE,CONTINUO',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
        ]);

        $horario = HorarioEstancia::create([
            'id_estancia' => $idEstancia,
            ...$validated
        ]);

        return response()->json($horario, 201);
    }

    /**
     * Actualizar horario
     */
    public function actualizarHorario(Request $request, $idEstancia, $idHorario)
    {
        $horario = HorarioEstancia::findOrFail($idHorario);
        $horario->update($request->all());

        return response()->json($horario);
    }

    /**
     * Eliminar horario
     */
    public function eliminarHorario($idEstancia, $idHorario)
    {
        HorarioEstancia::findOrFail($idHorario)->delete();

        return response()->json(['message' => 'Horario eliminado']);
    }

    /**
     * Obtener vacaciones/días libres
     */
    public function obtenerVacaciones($idEstancia)
    {
        $vacaciones = NotaSeguimiento::where('id_estancia', $idEstancia)
            ->whereIn('accion', ['VACACIONES', 'DIA_LIBRE'])
            ->get();

        return response()->json($vacaciones);
    }

    /**
     * Registrar vacaciones
     */
    public function registrarVacaciones(Request $request, $idEstancia)
    {
        $validated = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'tipo' => 'required|in:VACACIONES,DIA_LIBRE',
            'descripcion' => 'nullable|string'
        ]);

        // Crear nota de seguimiento
        $nota = NotaSeguimiento::create([
            'id_estancia' => $idEstancia,
            'id_alumno' => EstanciaFormativa::find($idEstancia)->id_alumno,
            'fecha' => $validated['fecha_inicio'],
            'accion' => $validated['tipo'],
            'contenido' => $validated['descripcion'] ?? "{$validated['tipo']}: {$validated['fecha_inicio']} a {$validated['fecha_fin']}"
        ]);

        return response()->json($nota, 201);
    }

    /**
     * Obtener notas/anotaciones
     */
    public function obtenerNotas($idEstancia)
    {
        $notas = NotaSeguimiento::where('id_estancia', $idEstancia)
            ->orderBy('fecha', 'desc')
            ->get();

        return response()->json($notas);
    }

    /**
     * Crear nota
     */
    public function crearNota(Request $request, $idEstancia)
    {
        $validated = $request->validate([
            'id_alumno' => 'required|exists:alumnos,id',
            'fecha' => 'required|date',
            'accion' => 'required|in:PRESENTACION_ALUMNO,LLAMADA_SEGUIMIENTO,VISITA_CENTRO_TRABAJO,REUNION_PROFESORES,REUNION_TUTOR_PRACTICAS,INCIDENCIA,EVALUACION,OTRA',
            'contenido' => 'required|string'
        ]);

        $nota = NotaSeguimiento::create([
            'id_estancia' => $idEstancia,
            ...$validated
        ]);

        return response()->json($nota, 201);
    }

    /**
     * Actualizar nota
     */
    public function actualizarNota(Request $request, $idEstancia, $idNota)
    {
        $nota = NotaSeguimiento::where('id_estancia', $idEstancia)->findOrFail($idNota);

        $validated = $request->validate([
            'fecha' => 'sometimes|date',
            'accion' => 'sometimes|in:PRESENTACION_ALUMNO,LLAMADA_SEGUIMIENTO,VISITA_CENTRO_TRABAJO,REUNION_PROFESORES,REUNION_TUTOR_PRACTICAS,INCIDENCIA,EVALUACION,OTRA,VACACIONES,DIA_LIBRE',
            'contenido' => 'sometimes|string'
        ]);

        $nota->update($validated);

        return response()->json($nota);
    }

    /**
     * Eliminar nota
     */
    public function eliminarNota($idEstancia, $idNota)
    {
        $nota = NotaSeguimiento::where('id_estancia', $idEstancia)->findOrFail($idNota);
        $nota->delete();
        return response()->json(['message' => 'Nota eliminada']);
    }

    /**
     * Actualizar progreso de horas
     */
    public function actualizarProgreso(Request $request, $idEstancia)
    {
        $validated = $request->validate([
            'horas_realizadas' => 'required|numeric|min:0'
        ]);

        $estancia = EstanciaFormativa::findOrFail($idEstancia);
        $estancia->update($validated);

        return response()->json($estancia);
    }

    /**
     * Actualizar fechas (y horas totales opcional) de la estancia
     */
    public function actualizarFechas(Request $request, $idEstancia)
    {
        $validated = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'horas_totales' => 'nullable|numeric|min:0'
        ]);

        $estancia = EstanciaFormativa::findOrFail($idEstancia);
        $estancia->update($validated);

        return response()->json($estancia);
    }
}