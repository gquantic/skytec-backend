<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Storage;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;

class Document extends Model
{
    use HasFactory;

    protected $casts = [
        'attachment' => 'array'
    ];

    protected $appends = ['document'];

    protected $guarded = [];

    public function attachment(): \Illuminate\Database\Eloquent\Builder|array|\Illuminate\Database\Eloquent\Collection|Model|false
    {
        return Attachment::query()->find($this->attachment[0] ?? 0) ?? false;
    }

    public function getDocumentAttribute()
    {
        $attachment = $this->attachment();
        if (!$attachment) {
            return false;
        }

        return Storage::disk('public')->url(
            $attachment->path . $attachment->name . '.' . $attachment->extension
        );
    }
}
