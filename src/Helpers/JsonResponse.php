<?php

namespace App\Helpers;

class JsonResponse
{
    public static function handle(string $message, array $data = [], string $error = null, int $statusCode = 200)
    {
        echo json_encode([
            'message' => $message,
            'data' => $data,
            'error' => $error,
            'status' => $statusCode
        ], JSON_PRETTY_PRINT);
    }
}