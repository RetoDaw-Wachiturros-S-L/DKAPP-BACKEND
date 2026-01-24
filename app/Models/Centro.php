<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Centro extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo_centro',
        'direccion',
        'poblacion',
    ];

    /**
     * Un centro tiene muchos tutores asociados.
     */
    public function tutores(): HasMany
    {
        return $this->hasMany(Tutor::class, 'id_centro');
    }
}