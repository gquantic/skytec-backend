<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Models\User;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use LdapRecord\Container;
use LdapRecord\Models\ActiveDirectory\User as LdapUser;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only('login', 'password');

        // Проверяем наличие пользователя в локальной базе данных
        $user = User::query()->where('login', $credentials['login'])->first();

        if ($user) {
            // Проверяем пароль в локальной базе данных
            if (Hash::check($credentials['password'], $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return ApiService::jsonResponse([
                    'user' => $user,
                    'token' => $token,
                ], 200);
            } else {
                return ApiService::jsonResponse('Неверный пароль.', 403);
            }
        } else {
            // Пытаемся аутентифицироваться через LDAP
            $ldapUser = $this->attemptLdapAuthentication($credentials['login'], $credentials['password']);

            if ($ldapUser) {
                // Создаем нового пользователя в локальной базе данных
                $user = User::create([
                    'name' => $ldapUser->getFirstAttribute('cn'),
                    'email' => $ldapUser->getFirstAttribute('mail'),
                    'login' => $credentials['login'],
                    'password' => Hash::make($credentials['password']),
                ]);

                $token = $user->createToken('auth_token')->plainTextToken;

                return ApiService::jsonResponse([
                    'user' => $user,
                    'token' => $token,
                ], 200);
            }

            return ApiService::jsonResponse('Пользователь с таким логином не найден.', 404);
        }
    }

    private function attemptLdapAuthentication($username, $password)
    {
        try {
            $connection = Container::getConnection('default');

            $ldapUser = \LdapRecord\Models\ActiveDirectory\User::findBy('uid', $username);

            if ($ldapUser && $connection->auth()->attempt($ldapUser->getDn(), $password)) {
                return $ldapUser;
            }
        } catch (\Exception $e) {
            return null;
        }

        return null;
    }


    public function register(Request $request)
    {
        $validated = $request->validate([
            'manager_id' => 'string|nullable',
            'department_id' => 'required',
            'position' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'surname' => 'required',
            'login' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'phone' => 'required',
            'birthdate' => 'required',
            'password' => 'required|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::query()->create($validated);

        return ApiService::jsonResponse([
                'user' => $user,
                'token' => $user->createToken('auth_token')->accessToken->token,
            ], 200);
    }

    public function registerEmployee(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'surname' => 'required',
            'employment_date' => 'required|date',
            'department_id' => 'required',
            'legal_entity' => 'required',
            'position' => 'required',
            'manager_id' => 'string|nullable',

        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::query()->create($validated);

        return ApiService::jsonResponse([
            'user' => $user,
            'token' => $user->createToken('auth_token')->accessToken->token,
        ], 200);
    }
}
