<?php

namespace App\Http\Controllers\Api\User;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Models\User;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function data(Request $request)
    {
        $user = User::query()->with(['manager' => function ($query) {
            $query->select('id', 'name');
        }])->select('name', 'login', 'phone', 'avatar', 'manager_id', 'email')->find($request->user()->id);

        return ApiService::jsonResponse($user, 200);
    }
}
