<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use LdapRecord\Container;
use LdapRecord\Models\openLDAP\User as LdapUser;

class AuthController extends Controller
{
    protected UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

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
                    'user' => $this->userRepository->getUserData($user->id),
                    'token' => $token,
                ], 200);
            } else {
                return ApiService::jsonResponse('Неверный пароль.', 403);
            }
        } else {
            // Пытаемся аутентифицироваться через LDAP
            $ldapUser = $this->attemptLdapAuthentication($credentials['login'], $credentials['password']);

            if ($ldapUser) {
                $fullName = $ldapUser->getFirstAttribute('cn');
                $explodedName = explode(' ', $fullName);

                // Создаем нового пользователя в локальной базе данных
                $user = $this->userRepository->createUser(data: [
                    'login' => $credentials['login'],
                    'email' => $ldapUser->getFirstAttribute('mail'),
                    'name' => $ldapUser->getFirstAttribute('cn'),
                    'firstname' => $explodedName[0] ?? '',
                    'lastname' => $explodedName[1] ?? '',
                    'surname' => $explodedName[2] ?? '',
                    'phone' => $ldapUser->getFirstAttribute('telephonenumber'),
                    'password' => Hash::make($credentials['password']),
                ]);

                $token = $user->createToken('auth_token')->plainTextToken;

                return ApiService::jsonResponse([
                    'user' => $this->userRepository->getUserData($user->id),
                    'token' => $token,
                ], 200);
            }

            return ApiService::jsonResponse('Пользователь с таким логином не найден.', 404);
        }
    }

    private function attemptLdapAuthentication($username, $password)
    {
        $connection = Container::getConnection('default');

        $ldapUser = \LdapRecord\Models\openLDAP\User::findBy('uid', $username);

        if ($ldapUser && $connection->auth()->attempt($ldapUser->getDn(), $password)) {
            return $ldapUser;
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
