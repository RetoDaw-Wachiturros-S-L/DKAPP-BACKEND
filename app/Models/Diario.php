<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diario extends Model
{
    protected $table = 'notas_seguimiento';

    protected $fillable = [
        'id',
        'id_estancia',
        'id_alumno',
        'fecha',
        'accion',
        'contenido'
    ];

    protected $appends = ['accion_legible'];

    public function alumno(){
        return $this->belongsTo(Alumno::class, 'id_alumno', 'id');
    }

    public function getAccionLegibleAttribute(){
        return match ($this->accion) {
            'PRESENTACION_ALUMNO'       => 'Presentación en la empresa',
            'LLAMADA_SEGUIMIENTO'       => 'Reunión con la empresa',
            'VISITA_CENTRO_TRABAJO'     => 'Visita al centro de trabajo',
            'REUNION_PROFESORES'        => 'Reunion de profesores',
            'REUNION_TUTOR_PRACTICAS'   => 'Reunion con tutor de practicas',
            'INCIDENCIA'                => 'Incidencia',
            'EVALUACION'                => 'Evaluacion',
            default                     => ucfirst(str_replace('_', ' ', $this->accion)),
        };
    }

    public static $acciones = [
        'Presentación en la empresa'     => 'PRESENTACION_ALUMNO',
        'Reunión con la empresa'         => 'LLAMADA_SEGUIMIENTO',
        'Visita al centro de trabajo'    => 'VISITA_CENTRO_TRABAJO',
        'Reunion de profesores'          => 'REUNION_PROFESORES',
        'Reunion con tutor de practicas' => 'REUNION_TUTOR_PRACTICAS',
        'Incidencia'                     => 'INCIDENCIA',
        'Evaluacion'                     => 'EVALUACION',
    ];
}

