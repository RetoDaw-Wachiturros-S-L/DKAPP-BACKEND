<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'nivel',
        'activo',
    ];

    /**
     * Relación con Alumnos (un ciclo tiene muchos alumnos)
     */
    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'id_ciclo');
    }
}
