<?php

namespace App\Http\Controllers;

use App\Models\Competencia;

class CompetenciaController extends Controller
{
    public function index()
    {
        return response()->json(
            Competencia::where('tipo', 'TECNICA')->get()
        );
    }
}
