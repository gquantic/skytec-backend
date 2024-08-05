<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\DepartmentRepository;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use LdapRecord\Container;
use LdapRecord\Models\ActiveDirectory\User as LdapUser;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    protected UserRepository $userRepository;
    protected DepartmentRepository $departmentRepository;


    public function __construct(UserRepository $userRepository, DepartmentRepository $departmentRepository)
    {
        $this->userRepository = $userRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only('login', 'password');
        $credentials['login'] = Str::lower($credentials['login']);

        // Проверяем наличие пользователя в локальной базе данных
        if (
            false
//            $user = User::query()->where('login', $credentials['login'])->first() //&& config('app.debug') === 'local'
        ) {
            // Проверяем пароль в локальной базе данных
            if (Hash::check($credentials['password'], $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return ApiService::jsonResponse([
                    'user' => $this->userRepository->getUserData($user->id),
                    'token' => $token,
                    'permissions' => $user->permissions,
                ], 200);
            } else {
                return ApiService::jsonResponse('Неверный пароль.', 403);
            }
        } else {
            // Пытаемся аутентифицироваться через LDAP
            $ldapUser = $this->attemptLdapAuthentication($credentials['login'], $credentials['password']);

            if ($ldapUser) {
//                $fullName = $ldapUser->getFirstAttribute('cn');
//                $explodedName = explode(' ', $fullName);

//                $data = [
//                    'avatar' => $this->pasteImage($ldapUser->getFirstAttribute('thumbnailphoto')),
//                    'login' => $credentials['login'],
//                    'email' => $ldapUser->getFirstAttribute('mail'),
//                    'name' => $ldapUser->getFirstAttribute('cn'),
//                    'firstname' => $explodedName[0] ?? '',
//                    'lastname' => $explodedName[1] ?? '',
//                    'surname' => $explodedName[2] ?? '',
//                    'phone' => $ldapUser->getFirstAttribute('phone'),
//                    'password' => Hash::make($credentials['password']),
//                    'position' => $ldapUser->getFirstAttribute('title'),
//                    'department_id' => $this->departmentRepository->firstOrCreate(['title' => $ldapUser->getFirstAttribute('department')], [])->id
//                ];

//              Создаем нового пользователя в локальной базе данных
                //$user = $this->userRepository->createUser(data: $data);

                if ($user = User::query()->where('email', $ldapUser->getFirstAttribute('mail'))->orWhere('login', $ldapUser->getFirstAttribute('sAMAccountName'))->first()) {
                    $token = $user->createToken('auth_token')->plainTextToken;

                    return ApiService::jsonResponse([
                        'user' => $this->userRepository->getUserData($user->id),
                        'token' => $token,
                    ], 200);
                }
            }

            return ApiService::jsonResponse('Пользователь с таким логином не найден.', 404);
        }
    }

    private function attemptLdapAuthentication($username, $password)
    {
        $connection = Container::getConnection('default');

        $ldapUser = \LdapRecord\Models\ActiveDirectory\User::findBy('sAMAccountName', $username);

        if (!$ldapUser) {
            $ldapUser = \LdapRecord\Models\ActiveDirectory\User::findBy('mail', $username);
        }

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

    private function pasteImage($byteArray)
    {
        // Преобразование строки в байтовый массив
        $imageData = pack('H*', bin2hex($byteArray));

        // Декодирование изображения (например, если это изображение в формате PNG)
        $image = imagecreatefromstring($imageData);

        if ($image === false) {
            throw new Exception('Не удалось создать изображение из байтового массива.');
        }

        // Установка сохранения альфа-канала (прозрачности)
        imagesavealpha($image, true);

        // Создание прозрачного фона
        $transparent = imagecolorallocatealpha($image, 0, 0, 0, 127);
        imagefill($image, 0, 0, $transparent);

        // Сохранение изображения в файл PNG
        $filename = time() . '_' . rand(999, 99999) . '_' . '.png';
        $path = storage_path('app/public/' . $filename);
        imagepng($image, $path);

        // Освобождение памяти
        imagedestroy($image);

        // Использование хранилища Laravel для сохранения файла
        Storage::put('public/users/avatars/' . $filename, file_get_contents($path));

        return Storage::disk('public')->url('/users/avatars/' . $filename);
    }
}
