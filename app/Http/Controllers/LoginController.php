<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (empty($credentials['email']) || empty($credentials['password'])) {
                return response()->json(['message' => 'Email and password required'], 400);
            }

            // Buscamos el usuario y cargamos las relaciones correctas:
            // Usamos 'tutor.centro' en singular para conectar con la tabla centros
            $user = User::with(['alumno.ciclo', 'tutor.centro'])
                ->where('email', $credentials['email'])
                ->first();

            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                Log::warning('Login failed for: ' . $credentials['email']);
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // Generar el token de Sanctum
            $token = $user->createToken('auth_token')->plainTextToken;

            // Retornamos la respuesta con toLoginArray() que ya tiene el cod_centro
            return response()->json([
                'token' => $token,
                'token_type' => 'Bearer',
                'user' => $user->toLoginArray(),
            ]);

        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return response()->json(['message' => 'Server error'], 500);
        }
    }
}