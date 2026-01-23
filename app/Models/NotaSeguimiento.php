<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotaSeguimiento extends Model
{
    protected $fillable = [
        'id_estancia',
        'id_alumno',
        'fecha',
        'accion',
        'contenido'
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function estancia(): BelongsTo
    {
        return $this->belongsTo(EstanciaFormativa::class, 'id_estancia');
    }

    public function alumno(): BelongsTo
    {
        return $this->belongsTo(Alumno::class, 'id_alumno');
    }
}