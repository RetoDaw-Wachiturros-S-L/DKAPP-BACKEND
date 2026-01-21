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
}
