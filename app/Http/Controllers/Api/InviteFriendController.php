<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InviteFriendController extends Controller
{
    public function store(Request $request)
    {
        return $request->allFiles();
    }
}
