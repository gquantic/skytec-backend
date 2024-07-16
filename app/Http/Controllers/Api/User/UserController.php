<?php

namespace App\Http\Controllers\Api\User;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Models\User;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function data(Request $request)
    {
        $user = User::query()->with(['manager' => function ($query) {
            $query->select('id', 'firstname', 'lastname', 'surname');
        }, 'department'])->find($request->user()->id);

        return ApiService::jsonResponse(['user' => $user, 'permissions' => $user->permissions], 200);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        try {
            $user = $request->user();
            foreach ($data as $key => $value) {
                $user->$key = $value;
            }
            $user->save();

            return $user;
        } catch (\Exception $exception) {
            throw new ApiException($exception->getMessage());
        }
    }

    public function show(int $id)
    {
        $user = User::query()->with(['manager' => function ($query) {
            $query->select('id', 'firstname', 'lastname', 'surname');
        }, 'department'])->find($id);

        if ($user->hide_phone) {
            $user->phone = 'Скрыт';
        }

        return ApiService::jsonResponse($user, 200);
    }

    public function articles(Request $request)
    {
        return Auth::user()->articles;
    }
}
