<?php

namespace App\Helpers\Traits\Model;

trait ViewsTrait
{
    public function updateViews($id)
    {
        $this->views++;
        $this->save();
    }

    public function getViewsAttribute($value): int
    {
        return $value ?? 0;
    }

    public function getViewsCountAttribute(): int
    {
        return (int) $this->views;
    }
}
