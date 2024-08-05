<?php

namespace App\Imports;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Repositories\DepartmentRepository;

class UsersImport implements ToCollection
{
    protected array $cells;

    protected DepartmentRepository $departmentRepository;
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->departmentRepository = new DepartmentRepository();
        $this->userRepository = new UserRepository();

        $this->cells = [
            'fio' => 0, // ФИО
            'if' => 1, // ИФ на латинице(заполняет ИТ отдел)
            'email' => 2, // Адрес электронной почты
            'position' => 3, // Должность
            'department' => 4, // Отдел
            'head' => 5, // Непосредственный руководитель
            'head_lat' => 6, // Непосредственный руководитель на латинице
        ];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            if ($row[$this->cells['fio']] == 'ФИО' || $row[$this->cells['email']] == '') {
                continue;
            }

            $ldapUser = \LdapRecord\Models\ActiveDirectory\User::findBy('mail', trim($row[$this->cells['email']]));

            if ($ldapUser == null) {
                continue;
            }

            $explodedName = explode(' ', $row[$this->cells['fio']]);

            $data = [
                'avatar' => $ldapUser->getFirstAttribute('thumbnailphoto') != '' ? $this->pasteImage($ldapUser->getFirstAttribute('thumbnailphoto')) : '',
                'name' => $row[$this->cells['fio']],
                'login' => $ldapUser->getFirstAttribute('sAMAccountName'),
                'firstname' => $explodedName[0] ?? '',
                'lastname' => $explodedName[1] ?? '',
                'surname' => $explodedName[2] ?? '',
                'password' => Hash::make(Str::random(8)),
                'position' => trim($row[$this->cells['position']]),
            ];

            if (trim($row[$this->cells['department']]) != '') {
                $data['department_id'] = $this->departmentRepository->firstOrCreate(['title' => trim($row[$this->cells['department']])], [])->id;
            }

            User::query()->updateOrCreate([
                'email' => trim($row[$this->cells['email']])
            ], $data);
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