<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $table = 'tutores';

    protected $fillable = [
        'id_user',
        'dni',
        'es_de_egibide',
        'poblacion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function ciclos()
    {
        return $this->belongsToMany(Ciclo::class, 'tutores_ciclos', 'id_tutor', 'id_ciclo');
    }

    public function practicasTutorCentro()
    {
        return $this->hasMany(EstanciaFormativa::class, 'id_tutor_centro');
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumnos_tutores', 'id_tutor', 'id_alumno');
    }
}
