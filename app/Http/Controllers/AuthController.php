<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create($validated);

        $token = $user->createToken($validated['username']);

        return $this->success('Registered Successfully', [
            'user' => new UserResource($user),
            'token' => $token->plainTextToken
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $user = User::where('username', $validated['username'])->first();

        if (!$user || !Hash::check($validated['password'], $user['password'])) {
            return $this->error('The provided credentials are incorrect');
        }

        $token = $user->createToken($user['username']);

        return $this->success('Successfully Login', [
            'user' => new UserResource($user),
            'token' => $token->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->success('You are logged out');
    }
}
