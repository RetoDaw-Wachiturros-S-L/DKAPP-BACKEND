<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    public function ciclo(){
        return $this->belongsTo(Ciclo::class, 'id_ciclo');
    }

    public function modulos(){
        return $this->hasMany(Modulo::class, 'id_curso');
    }
}
