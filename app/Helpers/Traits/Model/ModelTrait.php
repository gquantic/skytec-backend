<?php

namespace App\Helpers\Traits\Model;

use Carbon\Carbon;

trait ModelTrait
{
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y');
    }
}
