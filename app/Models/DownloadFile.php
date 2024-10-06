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
    ];

    protected $appends = [
        'download'
    ];

    protected $guarded = [];

//    public function getDocumentAttribute()
//    {
//        return $this->url;
//    }

    public function getDownloadAttribute()
    {
        return Storage::disk('public')->url($this->url);
    }
}
