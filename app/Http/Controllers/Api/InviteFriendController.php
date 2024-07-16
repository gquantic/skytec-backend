<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MailService;
use Illuminate\Http\Request;

class InviteFriendController extends Controller
{
    public function store(Request $request)
    {
        $mail = MailService::sendForm('axo_request',
            'Приглашение друга',
            $request->collect('data')->toArray(),
            files: $request->allFiles(),
        );
    }
}
