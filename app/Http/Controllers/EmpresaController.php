<?php

namespace App\Http\Controllers;
use App\Models\Empresa;
use App\Models\User;
use App\Models\EstanciaFormativa;

use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        try {
            $empresas = Empresa::all();
            return response()->json($empresas);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al cargar empresas',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function tutores($id){
        try {
            // Obtenemos todos los IDs de tutores de empresa asociados a estancias de esa empresa
            $tutoresIds = EstanciaFormativa::where('id_empresa', $id)
                ->pluck('id_tutor_empresa')
                ->unique();

            // Si no hay estancias, obtener todos los tutores de empresa
            if ($tutoresIds->isEmpty()) {
                $tutores = User::where('rol', 'TUTOR_EMPRESA')
                    ->where('activo', true)
                    ->get(['id', 'nombre', 'apellidos', 'email']);
            } else {
                // Si hay estancias, obtener solo los tutores de esas estancias
                $tutores = User::whereIn('id', $tutoresIds)
                    ->where('rol', 'TUTOR_EMPRESA')
                    ->where('activo', true)
                    ->get(['id', 'nombre', 'apellidos', 'email']);
            }

            return response()->json($tutores);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se pudieron cargar los tutores de empresa',
                'message' => $e->getMessage()
            ], 500);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
