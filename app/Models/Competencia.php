<?php

// app/Models/Competencia.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    protected $table = 'competencias';

    protected $fillable = [
        'codigo',
        'descripcion',
        'tipo'
    ];

    public $timestamps = true;
}
