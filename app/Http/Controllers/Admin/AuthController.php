<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('admin.auth.login');
    }

    public function processLogin(Request $request)
    {
        if ($user = \App\Models\User::query()->where('email', $request->email)->first()) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('platform.main');
            } else abort(403, 'Неверные данные входа');
        } else abort(403, 'Неверные данные входа');
    }
}
