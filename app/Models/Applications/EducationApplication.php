<?php

namespace App\Models\Applications;

use App\Models\Education;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationApplication extends Model
{
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function education(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Education::class);
    }
}
