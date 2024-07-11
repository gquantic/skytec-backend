<?php

namespace App\Services;

use App\Repositories\ConfigRepository;
use Illuminate\Support\Facades\DB;

class AppConfigService
{
    protected array $configurations;

    public function __construct(ConfigRepository $repository)
    {
        $this->configurations = $repository->all();
    }

    public function get($key, $default = null, $dev = false)
    {
        if (!$dev) {
            return $this->configurations[$key] ?? $default;
        } else {
            // Если это dev окружение, то заменяем значением аргумента $dev
            if (config('app.env') === 'production')
                return $this->configurations[$key] ?? $default;
            else
                return $dev;
        }
    }

    public function check($key): bool
    {
        return isset($this->configurations[$key]);
    }
}
