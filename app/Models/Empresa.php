<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $fillable = [
        'nombre',
        'cif',
        'direccion',
        'localidad',
        'provincia',
        'codigo_postal',
        'telefono',
        'email',
        'estado',
    ];

    // 🔗 Relación con contactos
    public function contactos()
    {
        return $this->hasMany(ContactoEmpresa::class, 'id_empresa');
    }

    // 🔗 Relación con estancias formativas
    public function estancias()
    {
        return $this->hasMany(EstanciaFormativa::class, 'id_empresa');
    }
}
