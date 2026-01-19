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

            Log::info('Login attempt', $credentials);

            // Validar que los campos estén presentes
            if (!$credentials['email'] || !$credentials['password']) {
                return response()->json(['message' => 'Email and password required'], 400);
            }

            Log::info('Attempting auth with credentials', ['email' => $credentials['email']]);

            // Find user by email and load relations
            $user = User::with(['alumno.ciclo'])
                ->where('email', $credentials['email'])
                ->first();

            if (!$user) {
                Log::warning('User not found', ['email' => $credentials['email']]);
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            Log::info('User found', ['user_id' => $user->id, 'email' => $user->email]);

            // Verify password
            if (!Hash::check($credentials['password'], $user->password)) {
                Log::warning('Invalid password for user', ['email' => $credentials['email']]);
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            Log::info('Password verified, creating token', ['user_id' => $user->id]);

            // Create token
            $token = $user->createToken('auth_token')->plainTextToken;

            Log::info('Token created successfully', ['user_id' => $user->id]);

            // Asegurar que las relaciones están cargadas antes de serializar
            $user->load(['alumno.ciclo']);

            return response()->json([
                'token' => $token,
                'token_type' => 'Bearer',
                'user' => $user->toLoginArray(),
            ]);
        } catch (\Exception $e) {
            Log::error('Login error', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Server error: ' . $e->getMessage()], 500);
        }
    }
}
