<?php

namespace App\Models;

use App\Helpers\Traits\Model\ModelTrait;
use App\Models\Applications\EducationApplication;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use ModelTrait, HasFactory;

    protected $casts = [
        'dates' => 'array',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function applications(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EducationApplication::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', 1);
    }
}
