<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'dni',
        'numero_cuaderno',
        'id_ciclo',
        'curso_actual',
        'poblacion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'id_ciclo');
    }

    public function cursos() {
        return $this->hasManyThrough(
            Curso::class,
            Ciclo::class,
            'id',
            'id_ciclo',
            'id_ciclo',
            'id'
        );
    }

    public function modulos() {
        return $this->hasManyThrough(
            Modulo::class,
            Curso::class,
            'id_ciclo',
            'id_curso',
            'id_ciclo',
            'id'
        );
    }

    public function tutores()
    {
        return $this->belongsToMany(Tutor::class, 'alumnos_tutores', 'id_alumno', 'id_tutor');
    }

    public function notasSeguimiento(){
    return $this->hasMany(Diario::class, 'id_alumno', 'id')
        ->select('id', 'id_alumno', 'fecha', 'accion', 'contenido');
    }

    public function estanciaFormativa(){
        return $this->hasOne(EstanciaFormativa::class, 'id_alumno', 'id');
    }

    public function evaluaciones(){
        return $this->hasMany(Evaluacion::class, 'id_modulo');
    }


    public function InvokeObject(){
        return [
            'id'        => $this->id,
            'nombre'    => $this->user->nombre,
            'apellidos' => $this->user->apellidos,
            'email'     => $this->user->email,
            'telefono'  => $this->user->telefono,
            'poblacion' => $this->poblacion,
            'curso'     => $this->curso_actual,
            'ciclo'     => $this->ciclo ? $this->ciclo->nombre : 'Sin ciclo',
            'familia'   => $this->ciclo ? $this->ciclo->familia_profesional : 'Sin familia',
            'cursos'    => $this->cursos,
            'modulos'   => $this->modulos->map(function ($modulo) {
                return [
                    'id' => $modulo->id,
                    'nombre' => $modulo->nombre,
                    'id_curso' => $modulo->id_curso,
                    'evaluaciones' => $modulo->evaluaciones ?? [],
                ];
            }),
            'diario'    => $this->notasSeguimiento,
            'estancia_formativa' => $this->estanciaFormativa,
        ];
    }
}
