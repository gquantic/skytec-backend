<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function createUser(array $data): User
    {
        $user = new User();

        foreach ($data as $key => $value) {
            $user->$key = $value;
        }

        $user->save();
        return $user;
    }

    public function getUserData(int $id): Model
    {
        return User::query()->with(['manager' => function ($query) {
            $query->select('id', 'firstname', 'lastname', 'surname');
        }, 'department'])->find($id);
    }
}
