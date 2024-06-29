<?php

namespace App\Models\News;

use App\Helpers\Traits\Model\ModelTrait;
use App\Helpers\Traits\Model\ViewsTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory, ModelTrait, ViewsTrait;

    protected $casts = [
    ];

    protected $appends = ['views_count'];

    protected $table = 'news';

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id', 'id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(NewsComment::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1)
            ->where('moderated', 1);
    }
}
