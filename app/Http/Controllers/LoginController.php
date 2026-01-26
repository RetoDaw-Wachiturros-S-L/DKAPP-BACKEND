<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            // Validar que los campos estén presentes
            if (!$credentials['email'] || !$credentials['password']) {
                return response()->json(['message' => 'Email and password required'], 400);
            }

            // Find user by email and load relations
            $user = User::with(['alumno.ciclo', 'tutor.centro'])
                ->where('email', $credentials['email'])
                ->first();

            // Mirar que existe el user o la contraseña es correcta
            if ( (!$user || !Hash::check($credentials['password'], $user->password))) {
               return response()->json(['message' => 'Unauthorized'], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            // Asegurar que las relaciones están cargadas antes de serializar
            $user->load(['alumno.ciclo', 'tutor.centro']);

            return response()->json([
                'token' => $token,
                'token_type' => 'Bearer',
                'user' => $user->toLoginArray(),
            ]);

        } catch (\Exception $e) {
           return response()->json(['message' => 'Server error: ' . $e->getMessage()], 500);
        }
    }
}
