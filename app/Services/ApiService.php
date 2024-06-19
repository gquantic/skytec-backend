<?php

namespace App\Services;

class ApiService
{
    public static function jsonResponse($message, int $code = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $message,
            'code' => $code,
        ]);
    }
}
