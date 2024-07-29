<?php

namespace App\Services;

class JavaScriptService
{
    public static function jsArray($array)
    {
        // Преобразуем массив в JSON строку
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }
}
