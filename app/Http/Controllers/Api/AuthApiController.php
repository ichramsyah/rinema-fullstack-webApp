<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite; // <-- TAMBAHKAN INI
use Illuminate\Support\Str;

class AuthApiController extends Controller
{
    /**
     * Handle a registration request for the application.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); // 422 Unprocessable Entity
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Buat token untuk user yang baru mendaftar
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Registrasi berhasil.',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], 201); // 201 Created
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Coba autentikasi user
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Email atau password salah.'
            ], 401); // 401 Unauthorized
        }

        $user = User::where('email', $request->email)->firstOrFail();

        // Hapus token lama jika ada, dan buat token baru
        $user->tokens()->delete();
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil.',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        // Cabut (revoke) token yang sedang digunakan untuk request ini
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil.'
        ]);
    }

   public function handleGoogleCallback(Request $request)
{

    try {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Buat atau perbarui user di database Anda
        $user = User::updateOrCreate(
            [
                'google_id' => $googleUser->getId(),
            ],
            [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_token' => $googleUser->token,
                'password' => Hash::make('password_google_'.Str::random(10)), // Password acak
                'email_verified_at' => now(),
            ]
        );

        // Buat API Token untuk user tersebut
        $token = $user->createToken('google-auth-token')->plainTextToken;

        // Kembalikan token dan data user sebagai respons JSON
        return response()->json([
            'message' => 'Login dengan Google berhasil.',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);

    } catch (\Exception $e) {
        // Tangani jika ada error
        return response()->json([
            'message' => 'Autentikasi gagal. Pastikan "code" valid.',
            'error' => $e->getMessage()
        ], 401);
    }
}
}