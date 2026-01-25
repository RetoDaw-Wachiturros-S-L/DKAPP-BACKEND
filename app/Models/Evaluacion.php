<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table = "evaluaciones";

    protected $fillable = [
        'id_modulo',
        'nota_previa',
        'nota_competencias_tecnicas',
        'nota_competencias_transversales',
        'nota_cuaderno',
        'nota_fct_calculada',
        'nota_final',
        'observaciones',
    ];

    public function modulo() {
        return $this->belongsTo(Modulo::class, 'id_modulo');
    }
}
