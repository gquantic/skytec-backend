<?php

namespace App\Models\Applications;

use App\Helpers\Traits\Model\RequestModelTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class VacationApplication extends Model
{
    use RequestModelTrait;

    protected $guarded = [];

    protected $appends = ['name'];

    protected $hidden = ['hash'];

    public function getNameAttribute($value): string
    {
        return 'Заявка на отпуск';
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
