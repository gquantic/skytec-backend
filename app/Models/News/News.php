<?php

namespace App\Models\News;

use App\Helpers\Traits\Model\ModelTrait;
use App\Helpers\Traits\Model\ViewsTrait;
use App\Models\Emoji;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory, ModelTrait, ViewsTrait;

    protected $casts = [
    ];

    protected $hidden = ['reactions'];

    protected $appends = ['views_count', 'users_reactions', 'user_reaction'];

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

    public function reactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(NewsReaction::class, 'news_id', 'id');
    }

    public function getUserReactionAttribute(): int
    {
        if ($reaction = $this->reactions()->where('user_id', auth()->id())->first()) {
            return $reaction->emoji_id;
        } else return 0;
    }

    public function getUsersReactionsAttribute()
    {
        $emojis = Emoji::all();
        $emojiArray = [];

        foreach ($emojis as $emoji) {
            $emojiArray[$emoji->id] = $emoji->image;
        }

        $reactions = $this->reactions;
        $returnReactions = [];

        foreach ($reactions as $reaction) {
            if (array_key_exists($reaction->emoji_id, $returnReactions)) {
                $returnReactions[$reaction->emoji_id]['count']++;
            } else {
                $returnReactions[$reaction->emoji_id] = [
                    'emoji_id' => $reaction->emoji_id,
                    'image' => $emojiArray[$reaction->emoji_id],
                    'count' => 1,
                ];
            }
        }

        return $returnReactions;
    }
}
