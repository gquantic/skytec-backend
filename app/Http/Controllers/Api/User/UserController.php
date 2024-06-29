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

class UserController extends Controller
{
    public function data(Request $request)
    {
        $user = User::query()->with(['manager' => function ($query) {
            $query->select('id', 'firstname', 'lastname', 'surname');
        }, 'department'])->find($request->user()->id);

        return ApiService::jsonResponse($user, 200);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        try {
            $user = $request->user();
            $user->firstname = $data['firstname'] ?? $user->firstname;
            $user->lastname = $data['lastname'] ?? $user->lastname;
            $user->surname = $data['surname'] ?? $user->surname;
            $user->phone = $data['phone'] ?? $user->phone;
            $user->email = $data['email'] ?? $user->email;
            $user->hide_phone = boolval($data['hide_phone']) ?? $user->hide_phone;
            $user->save();
        } catch (\Exception $exception) {
            throw new ApiException($exception->getMessage());
        }
    }

    public function articles(Request $request)
    {
        return Auth::user()->articles;
    }
}
