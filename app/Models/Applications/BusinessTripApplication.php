<?php

namespace App\Models\Applications;

use App\Helpers\Traits\Model\RequestModelTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessTripApplication extends Model
{
    use RequestModelTrait;

    protected $guarded = [];

    protected $appends = ['name'];

    public function getNameAttribute($value): string
    {
        return 'Заявка на командировку';
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
