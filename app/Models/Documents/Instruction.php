<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Orchid\Attachment\Models\Attachment;

class Instruction extends Model
{
    use HasFactory;

    protected $casts = [
        'attachment' => 'array'
    ];

    protected $appends = ['document'];

    protected $guarded = [];

    public function attachment()
    {
        if (is_array($this->attachment)) {
            return Attachment::query()->orderByDesc('created_at')->find($this->attachment[0] ?? 0) ?? false;
        } else {
            return Attachment::query()->orderByDesc('created_at')->find($this->attachment ?? 0) ?? false;
        }
    }

    public function getDocumentAttribute()
    {
        $attachment = $this->attachment();
        if (!$attachment) {
            return false;
        }

        return Storage::disk('public')->url(
            $attachment->path . $attachment->name
        );
    }
}
