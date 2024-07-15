<?php

namespace App\Services;

use App\Mail\Form\FormMail;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public static function sendForm(string $formType, string $formTitle = 'Форма с сайта', array $data)
    {
        return Mail::to(self::getMailAddresses($formType))->send(new FormMail(title: $formTitle, data: $data));
    }

    private static function getMailAddresses(string $formType)
    {
        return app_config()->get($formType, dev: config('mail.dev'));
    }
}
