<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);


        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        $token = $user->createToken('auth_token', ['user'])->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'user' => $user,
        ], Response::HTTP_CREATED);
    }

    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);


        if (!Auth::attempt([
                'email' => $data['email'],
                'password' => $data['password']
            ]) || !Auth::user()) {
            return response()->json([
                'error' => 'Unauthorized',

            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        $abilities = $user->isAdmin() ? ['admin'] : ['user'];
        $token = $user->createToken('auth_token', $abilities)->plainTextToken;
        return response()->json(['access_token' => $token, 'user' => $user]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAcessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
