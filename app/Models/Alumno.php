<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    // aqui hay que meter el fillable de alumno para obtener los datos desde user ( o front)
    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function cicloFormativo(){
        return $this->belongsTo(CicloFormativo::class, 'id_ciclo_formativo', 'id');
    }

    public function practicas(){
        return $this->hasMany(EstanciaFormativa::class, 'id_alumno', 'id');
    }
}
