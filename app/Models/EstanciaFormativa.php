<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstanciaFormativa extends Model
{
    protected $table = 'estancias_formativas';
    protected $fillable = [
        'id_alumno',
        'id_tutor_centro',
        'id_tutor_empresa',
        'fecha_inicio',
        'fecha_fin',
        'empresa',
        'direccion_empresa',
        'ciudad_empresa',
        'codigo_postal_empresa',
        'telefono_empresa',
        'actividad_empresa',
        'horario_practicas',
        'estado',
    ];

    public function alumno(){
        return $this->belongsTo(Alumno::class, 'id_alumno', 'id');
    }

    public function tutorCentro(){
        return $this->belongsTo(User::class, 'id_tutor_centro', 'id');
    }

    public function tutorEmpresa(){
        return $this->belongsTo(User::class, 'id_tutor_empresa', 'id');
    }

    public function empresa(){
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id');
    }

    public function curso(){
        return $this->belongsTo(Curso::class, 'id_curso', 'id');
    }
}
