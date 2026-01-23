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

    /**
     * Relación con User (un alumno pertenece a un usuario)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relación con Ciclo (un alumno pertenece a un ciclo)
     */
    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'id_ciclo');
    }

    public function tutores()
    {
        return $this->belongsToMany(Tutor::class, 'alumnos_tutores', 'id_alumno', 'id_tutor');
    }

    public function entradasDiario() {
        return $this->hasMany(Diario::class, 'id', 'numero_cuaderno');
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
            'entradas_diario' => $this->entradasDiario,
            ];
    }
}
