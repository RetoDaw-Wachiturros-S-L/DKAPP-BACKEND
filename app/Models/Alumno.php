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

    public function tutores()
    {
        return $this->belongsToMany(Tutor::class, 'alumnos_tutores', 'id_alumno', 'id_tutor');
    }

    public function notasSeguimiento(){
    // Hecho asi para devolver las acciones formateadas de Backend
    return $this->hasMany(Diario::class, 'id_alumno', 'id')
        ->select('id', 'id_alumno', 'fecha', 'accion', 'contenido');
    }

    public function estanciaFormativa(){
        return $this->hasOne(EstanciaFormativa::class, 'id_alumno', 'id');
    }

    public function InvokeObject()
    {
        return
        [
            'id'        => $this->id,
            'nombre'    => $this->user->nombre,
            'apellidos' => $this->user->apellidos,
            'email'     => $this->user->email,
            'telefono'  => $this->user->telefono,
            'poblacion' => $this->poblacion,
            'curso'     => $this->curso_actual,
            'ciclo'     => $this->ciclo ? $this->ciclo->nombre : 'Sin ciclo',
            'familia'   => $this->ciclo ? $this->ciclo->codigo : 'Sin familia',
            'diario'    => $this->notasSeguimiento,
            'estancia_formativa' => $this->estanciaFormativa,
        ];
    }
}
