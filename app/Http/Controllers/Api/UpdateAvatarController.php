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
//        return $file->getClientOriginalName();;
        $fileName = Carbon::now()->timestamp . '_' . $file->getClientOriginalName();
//
        $file->move(storage_path('/app/public/avatars/'), $fileName);
        $user = $request->user();
        $user->avatar = Storage::disk('public')->url("avatars/{$fileName}");
        $user->save();

        return $user;
    }
}
