<?php

namespace App\Repositories;

use App\Models\Site\Config;

class ConfigRepository
{
    public function all(): array
    {
        return Config::all()->select('name', 'value')->pluck('value', 'name')->toArray();
    }
}
