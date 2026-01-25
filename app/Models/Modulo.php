<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    public function curso(){
        return $this->belongsTo(Curso::class, 'id_curso');
    }

    public function evaluaciones() {
        return $this->hasMany(Evaluacion::class, 'id_modulo');
    }
}
