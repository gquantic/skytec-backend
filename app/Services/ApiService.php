<?php

namespace App\Services;

class ApiService
{
    public static function jsonResponse($message, int $code = 200, string $type = 'json')
    {
        return response()->json([
            'message' => self::getStatusMessage($code),
            'data' => $message,
            'code' => $code,
        ])->withHeaders(['Content-Type' => 'application/json']);
    }

    public static function getStatusMessage($statusCode)
    {
        switch ($statusCode):
            case 200:
                return 'OK';
                break;

            case 201:
                return 'Created';
                break;

            case 404:
                return 'Not Found';
                break;

            case 401:
                return 'Unauthorized';
                break;

            case 403:
                return 'Forbidden';
                break;

            default:
                return 'Unknown error';
                break;
        endswitch;
    }
}
