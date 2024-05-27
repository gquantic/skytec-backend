<?php

namespace App\Helpers\Traits;

use Carbon\Carbon;

trait ModelTrait
{
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y H:i');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y H:i');
    }
}
