<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateAvatarController extends Controller
{
    public function update(Request $request)
    {
        $file = $request->file('avatar');
        $fileName = Carbon::now()->timestamp . '.' . $file->extension();

        if ($request->hasFile('avatar')) {
           $file->storePubliclyAs('avatars', $fileName, [
               'disk' => 'public'
           ]);
           $user = $request->user();
           $user->avatar = Storage::disk('public')->url("avatars/{$fileName}");
           $user->save();

           return $user;
        }
    }
}
