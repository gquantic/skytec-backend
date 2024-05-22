<?php

namespace App\Services;

class ApiService
{
    public static function jsonResponse($message, $code)
    {
        return response()->json([
            'data' => $message,
            'code' => $code,
        ]);
    }
}
