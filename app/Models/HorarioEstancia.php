<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HorarioEstancia extends Model
{
    protected $fillable = [
        'id_estancia',
        'dia_semana',
        'turno',
        'hora_inicio',
        'hora_fin'
    ];

    public function estancia(): BelongsTo
    {
        return $this->belongsTo(EstanciaFormativa::class, 'id_estancia');
    }
}