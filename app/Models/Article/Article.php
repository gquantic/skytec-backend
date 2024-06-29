<?php

namespace App\Models\Article;

use App\Helpers\Traits\Model\ModelTrait;
use App\Helpers\Traits\Model\ViewsTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use ModelTrait, HasFactory, ModelTrait, ViewsTrait;

    protected $guarded = [];

    protected $casts = [
    ];

    protected $appends = ['views_count'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
