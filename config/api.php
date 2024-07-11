<?php

return [
    // Токен для передачи в заголовке (Bearer)
    'token' => env('API_TOKEN', ''),

    // Лимит запросов к API. Если клиент превысил лимит - сервер блокирует его выдавая ошибку.
    'max_requests_per_minute' => env('API_REQUESTS_LIMIT', 100),
];
