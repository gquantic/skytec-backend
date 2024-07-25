<?php

namespace App\Console\Commands\ldap;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use LdapRecord\Container;
use LdapRecord\Models\openLDAP\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\DepartmentRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Storage;

class GetAllUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ldap:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected UserRepository $userRepository;
    protected DepartmentRepository $departmentRepository;


    public function __construct(UserRepository $userRepository, DepartmentRepository $departmentRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = \LdapRecord\Models\ActiveDirectory\User::all();

        foreach ($users as $ldapUser) {
            $fullName = $ldapUser->getFirstAttribute('cn');
            $explodedName = explode(' ', $fullName);

//            dd($ldapUser->getFirstAttribute('sAMAccountName'));

           # if ($ldapUser->getFirstAttribute('mail') == '' || $ldapUser->getFirstAttribute('sAMAccountName') == '' || $ldapUser->getFirstAttribute('department') == '') {
            #    continue;
            #}

            $data = [
                'login' => Str::lower($ldapUser->getFirstAttribute('sAMAccountName')),
                'avatar' => $ldapUser->getFirstAttribute('thumbnailphoto') != '' ? $this->pasteImage($ldapUser->getFirstAttribute('thumbnailphoto')) : '',
                'email' => Str::lower($ldapUser->getFirstAttribute('mail')),
                'name' => $ldapUser->getFirstAttribute('cn'),
                'firstname' => $explodedName[0] ?? '',
                'lastname' => $explodedName[1] ?? '',
                'surname' => $explodedName[2] ?? '',
                'phone' => ($ldapUser->getFirstAttribute('telephoneNumber') ?? 'N/D'),
                'password' => Hash::make('changepassword'),
                'position' => $ldapUser->getFirstAttribute('title') ?? 'N/D',
                'department_id' => $ldapUser->getFirstAttribute('department') != '' ? $this->departmentRepository->firstOrCreate(['title' => $ldapUser->getFirstAttribute('department')], [])->id : ''
            ];

            if ($user = \App\Models\User::query()->where('login', $ldapUser->getFirstAttribute('sAMAccountName'))->orWhere('email', $ldapUser->getFirstAttribute('mail'))->first()) {
                foreach ($data as $key => $value) {
                    $user->$key = $value;
                }
                $user->save();
                $this->info("User {$data['name']} is updated...");
            } else {
                $user = $this->userRepository->createUser(data: $data);
                $this->info("User {$data['name']} is created...");
            }
        }
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
