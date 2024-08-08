<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    private function getDownloadLink(): string
    {
        if ($file = Attachment::query()->where('id', $this->url[0] ?? [])->first()) {
            return $file->url();
        } else return '';
    }
}
