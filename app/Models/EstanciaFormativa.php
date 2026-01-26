<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstanciaFormativa extends Model
{
    protected $table = 'estancias_formativas';

    protected $fillable = [
        'id_alumno', 'id_empresa', 'id_tutor_empresa', 'id_tutor_centro', 
        'id_curso', 'fecha_inicio', 'fecha_fin', 'horas_totales', 'horas_realizadas', 'estado', 'observaciones'
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'id_alumno', 'id');
    }

    public function tutorCentro()
    {
        return $this->belongsTo(User::class, 'id_tutor_centro', 'id');
    }

    public function tutorEmpresa()
    {
        return $this->belongsTo(User::class, 'id_tutor_empresa', 'id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso', 'id');
    }
        // app/Models/EstanciaFormativa.php

    public function competencias() {
        // Ajusta 'seguimiento_competencias' si el nombre de la tabla intermedia es otro
        return $this->belongsToMany(Competencia::class, 'seguimiento_competencias', 'id_estancia', 'id_competencia')
                    ->withPivot('fecha_inicio', 'fecha_fin')
                    ->withTimestamps();
    }

    public function tutores()
    {
        return $this->belongsToMany(Tutor::class, 'alumnos_tutores', 'id_alumno', 'id_tutor');
    }
}
