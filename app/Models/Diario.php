<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diario extends Model
{
    protected $table = 'notas_seguimiento';

    protected $fillable = [
        'id',
        'id_estancia',
        'id_alumno',
        'fecha',
        'accion',
        'contenido'
    ];

    public function alumno(){
        return parent::belongsTo(Alumno::class, 'id_alumno', 'id');
    }
}
