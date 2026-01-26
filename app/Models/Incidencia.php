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
        'id_usuario', // se guarda automáticamente en backend
    ];

    public function emitente()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }
}
