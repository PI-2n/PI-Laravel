<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return $this->sendError('Unauthorised', ['error' => 'Credencials incorrectes'], 401);
        }

        $user = $request->user();
        $result = [
            'token' => $user->createToken('api')->plainTextToken,
            'name' => $user->name,
        ];

        return $this->sendResponse($result, 'User signed in', 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors(), 422);
        }

        $data = $validator->validated();

        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 2, // Asigna rol 'customer' por defecto
        ]);

        $result = [
            'token' => $user->createToken('api')->plainTextToken,
            'name' => $user->name,
        ];

        return $this->sendResponse($result, 'User created successfully', 201);
    }

    /**
     * Log the user out (Invalidate the token).
     * 
     * @authenticated
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->sendResponse(['name' => $request->user()->name], 'User successfully signed out', 200);
    }

    public function redirectToGoogle()
    {
        return \Laravel\Socialite\Facades\Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = \Laravel\Socialite\Facades\Socialite::driver('google')->stateless()->user();

            $user = User::updateOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName(),
                'last_name' => '', // Add default or extract from name
                'username' => 'user_' . str()->random(8), // Generate unique username
                'google_id' => $googleUser->getId(),
                'password' => Hash::make(str()->random(24)),
                'email_verified_at' => now(),
                'role_id' => 3, // Customer
            ]);

            $token = $user->createToken('api')->plainTextToken;

            // Redirect to Frontend
            $frontendUrl = env('FRONTEND_URL', 'http://localhost:5173');
            return redirect("{$frontendUrl}/auth/callback?token={$token}");

        } catch (\Exception $e) {
            // Return error as JSON or redirect to frontend with error
            $frontendUrl = env('FRONTEND_URL', 'http://localhost:5173');
            return redirect("{$frontendUrl}/login?error=google_auth_failed");
        }
    }
}
