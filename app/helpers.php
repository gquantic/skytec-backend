<?php

use App\Services\AppConfigService;

if (!function_exists('app_config')) {
    function app_config()
    {
        return app(AppConfigService::class);
    }
}
