<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Orchid\Attachment\Models\Attachment;

class DownloadFile extends Model
{
    use HasFactory;

    protected $casts = [
        'url' => 'array'
    ];

    protected $appends = [
        'download'
    ];

    protected $guarded = [];

    public function download(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getDownloadLink()
        );
    }

    public function attachment()
    {
        if (is_array($this->url)) {
            return Attachment::query()->orderByDesc('created_at')->find($this->url[0] ?? 0) ?? false;
        } else {
            return Attachment::query()->orderByDesc('created_at')->find($this->url ?? 0) ?? false;
        }
    }

    private function getDownloadLink(): string
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
