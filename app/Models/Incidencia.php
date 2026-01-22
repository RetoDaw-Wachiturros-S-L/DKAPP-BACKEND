<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    protected $fillable = [
        'fecha_hora',
        'tipo_incidencia',
        'descripcion',
        'emitente_id', // se guarda automáticamente en backend
    ];

    public function emitente()
    {
        return $this->belongsTo(User::class, 'emitente_id');
    }

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }
}
