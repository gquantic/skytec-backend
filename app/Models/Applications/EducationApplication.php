<?php

namespace App\Models\Applications;

use App\Models\Education;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationApplication extends Model
{
    protected $appends = ['name'];

    protected $guarded = [];

    public function getNameAttribute($value): string
    {
        return "Заявка на обучение '{$this->education->title}'";
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function education(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Education::class);
    }
}
