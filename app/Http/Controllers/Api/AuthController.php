<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Models\User;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        if ($user = User::query()->where('login', $request->login)->first()) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return ApiService::jsonResponse([
                    'user' => $user,
                    'token' => $token,
                ], 200);
            } else {
                return ApiService::jsonResponse('Неверный пароль.', 403);
            }
        } else {
            return ApiService::jsonResponse('Пользователь с таким логином не найден.', 404);
        }
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'login' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::query()->create($validated);
        $user->password = Hash::make($request->password);
        $user->save();

        return ApiService::jsonResponse([
                'user' => $user,
                'token' => $user->createToken('auth_token')->accessToken->token,
            ], 200);
    }
}
