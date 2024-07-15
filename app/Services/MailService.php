<?php

namespace App\Services;

use App\Mail\Form\FormMail;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public static function sendForm(string $formType, array $data)
    {
        return Mail::to(app_config()->get($formType, dev: config('mail.dev')))->send(new FormMail(title: $formType, data: $data));
    }
}
